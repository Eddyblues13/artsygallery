(function () {
    'use strict';

    function reinitializeUi() {
        if (window.feather && typeof window.feather.replace === 'function') {
            window.feather.replace();
        }
        document.dispatchEvent(new CustomEvent('ajax:content-updated'));
    }

    function parseHtml(htmlText) {
        var parser = new DOMParser();
        return parser.parseFromString(htmlText, 'text/html');
    }

    function setLoading(target, isLoading) {
        if (!target) return;
        target.style.opacity = isLoading ? '0.7' : '1';
        target.style.pointerEvents = isLoading ? 'none' : 'auto';
        if (isLoading) {
            target.classList.add('searching');
        } else {
            target.classList.remove('searching');
        }
    }

    function loadIntoTarget(url, targetSelector, pushState) {
        var target = document.querySelector(targetSelector);
        if (!target) return;

        setLoading(target, true);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        })
            .then(function (response) {
                if (!response.ok) throw new Error('Request failed');
                return response.text();
            })
            .then(function (html) {
                var doc = parseHtml(html);
                var replacement = doc.querySelector(targetSelector);
                if (!replacement) {
                    window.location.href = url;
                    return;
                }

                target.innerHTML = replacement.innerHTML;
                if (pushState) {
                    window.history.pushState({}, '', url);
                }
                reinitializeUi();
            })
            .catch(function () {
                window.location.href = url;
            })
            .finally(function () {
                setLoading(target, false);
            });
    }

    function toQueryString(form) {
        var params = new URLSearchParams();
        new FormData(form).forEach(function (value, key) {
            if (value !== null && value !== '') {
                params.append(key, value);
            }
        });
        return params.toString();
    }

    function formTargetSelector(form) {
        return form.getAttribute('data-ajax-filter');
    }

    // Live search on text input with debounce
    function setupLiveSearch() {
        var forms = document.querySelectorAll('form[data-ajax-filter]');
        forms.forEach(function (form) {
            if (form.dataset.liveSearchBound === '1') return;
            form.dataset.liveSearchBound = '1';

            var searchInput = form.querySelector('input[name="search"]');
            if (!searchInput) return;

            var debounceTimer = null;
            var submitOnChange = function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    if (searchInput.value.trim() || form.querySelector('select').value || form.querySelector('input[type="date"]')) {
                        form.requestSubmit();
                    }
                }, 150); // Very responsive - 150ms
            };

            searchInput.addEventListener('input', submitOnChange);
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    clearTimeout(debounceTimer);
                    form.requestSubmit();
                }
            });

            // Also auto-submit on select/date changes
            form.querySelectorAll('select, input[type="date"], input[type="number"]').forEach(function (el) {
                el.addEventListener('change', function () {
                    form.requestSubmit();
                });
            });
        });
    }

    document.addEventListener('DOMContentLoaded', setupLiveSearch);
    document.addEventListener('ajax:content-updated', setupLiveSearch);

    document.addEventListener('submit', function (event) {
        var form = event.target.closest('form[data-ajax-filter]');
        if (!form) return;

        var method = (form.getAttribute('method') || 'GET').toUpperCase();
        if (method !== 'GET') return;

        var targetSelector = formTargetSelector(form);
        if (!targetSelector) return;

        event.preventDefault();

        var action = form.getAttribute('action') || window.location.pathname;
        var query = toQueryString(form);
        var url = query ? (action + (action.indexOf('?') >= 0 ? '&' : '?') + query) : action;

        loadIntoTarget(url, targetSelector, true);
    });

    document.addEventListener('click', function (event) {
        var paginationLink = event.target.closest('.admin-pagination-wrap a, .user-pagination-wrap a, .pagination a');
        if (paginationLink) {
            var ajaxContainer = paginationLink.closest('[data-ajax-container]');
            if (ajaxContainer) {
                event.preventDefault();
                var targetSelector = '#' + ajaxContainer.id;
                loadIntoTarget(paginationLink.href, targetSelector, true);
                return;
            }
        }

        var ajaxLink = event.target.closest('a[data-ajax-filter-link]');
        if (!ajaxLink) return;

        var targetSelectorFromLink = ajaxLink.getAttribute('data-ajax-filter-link');
        if (!targetSelectorFromLink) return;

        event.preventDefault();
        loadIntoTarget(ajaxLink.href, targetSelectorFromLink, true);
    });
})();
