import os, re

files = [
    r"c:\Users\user\Artisttocollectors-1\resources\views\home\what_is_nft.blade.php",
    r"c:\Users\user\Artisttocollectors-1\resources\views\home\how-to-buy-nft.blade.php",
    r"c:\Users\user\Artisttocollectors-1\resources\views\home\what-are-nft-drops.blade.php",
    r"c:\Users\user\Artisttocollectors-1\resources\views\home\what-is-crypto-wallet.blade.php",
    r"c:\Users\user\Artisttocollectors-1\resources\views\home\what-is-blockchain.blade.php",
    r"c:\Users\user\Artisttocollectors-1\resources\views\home\nft-gas-fees.blade.php",
    r"c:\Users\user\Artisttocollectors-1\resources\views\home\what-is-web3.blade.php",
    r"c:\Users\user\Artisttocollectors-1\resources\views\what-is-cryptocurrency.blade.php"
]

template = """@include('home.header')
<!-- Hero Section -->
<section class="py-24 md:py-32 bg-slate-50 border-b border-slate-200">
    <div class="container mx-auto px-4 max-w-4xl text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-6 tracking-tight">__TITLE__</h1>
        <p class="text-xl text-slate-600 leading-relaxed max-w-2xl mx-auto">__SUBTITLE__</p>
    </div>
</section>
<!-- Content Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            <div>
                __BODY__
                <div class="flex flex-col sm:flex-row gap-4 mt-8">
                    <a href="{{route('homepage')}}#explore" class="px-8 py-3.5 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-all duration-300 shadow-sm text-center">Explore Marketplace</a>
                    <a href="{{route('register')}}" class="px-8 py-3.5 bg-slate-50 border border-slate-200 text-slate-700 rounded-xl font-bold hover:bg-slate-100 transition-all duration-300 text-center">Start Creating</a>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="bg-gradient-to-tr from-primary/10 to-transparent p-6 rounded-[2.5rem]">
                    <img src="__IMG_SRC__" alt="Feature Image" class="rounded-3xl shadow-lg w-full object-cover">
                </div>
            </div>
        </div>
        __EXTRA_CONTENT__
    </div>
</section>
@include('home.footer')"""

def clean_tags(text):
    return re.sub(r'<[^>]+>', '', text).strip()

def process_file(path):
    if not os.path.exists(path):
        print(f"Skipping {path}, not found.")
        return
    with open(path, 'r', encoding='utf-8') as fobj:
        content = fobj.read()
    
    # Extract Title
    title_match = re.search(r'<h1[^>]*>(.*?)</h1>', content, re.DOTALL)
    title = clean_tags(title_match.group(1)) if title_match else "Information"
    
    # Extract Paragraphs
    ps = re.findall(r'<p[^>]*>(.*?)</p>', content, re.DOTALL)
    subtitle = clean_tags(ps[0]) if len(ps) > 0 else "Learn more about Web3 and NFTs."
    
    body = ""
    if len(ps) > 1:
        for p in ps[1:3]: # Take next 2 paragraphs for body
            body += f'<p class="text-lg text-slate-600 leading-relaxed mb-6">{clean_tags(p)}</p>\\n'
            
    extra = ""
    # Look for extra h1s as h2s to retain structure
    headers = re.findall(r'<h1[^>]*>(.*?)</h1>', content, re.DOTALL)
    if len(headers) > 1 or len(ps) > 3:
        extra += '<div class="mt-20 max-w-4xl mx-auto space-y-8">\\n'
        for idx, h in enumerate(headers[1:]):
            extra += f'<h2 class="text-3xl font-bold text-slate-900 mb-6">{clean_tags(h)}</h2>\\n'
            if len(ps) > 3 + idx:
                extra += f'<p class="text-lg text-slate-600 leading-relaxed mb-6">{clean_tags(ps[3+idx])}</p>\\n'
        # For remaining paragraphs with no header match
        for p in ps[3+len(headers)-1:]:
            extra += f'<p class="text-lg text-slate-600 leading-relaxed mb-6">{clean_tags(p)}</p>\\n'
        extra += '</div>'
        
    # Extract Image
    img_match = re.search(r'<img.*?src=["\'](.*?)["\'].*?>', content)
    img_src = img_match.group(1) if img_match else "images/items/what.png"
    if "{{" in img_src: img_src = "images/items/what.png" # Safe fallback
    
    out = template.replace("__TITLE__", title) \
                  .replace("__SUBTITLE__", subtitle) \
                  .replace("__BODY__", body) \
                  .replace("__IMG_SRC__", img_src) \
                  .replace("__EXTRA_CONTENT__", extra)
    
    with open(path, 'w', encoding='utf-8') as fobj:
        fobj.write(out)
    print(f"Processed nicely: {path}")

for f in files:
    process_file(f)

print("SUCCESS")
