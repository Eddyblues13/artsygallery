/**
 * Generate ArtistToCollectors PNG logos using pure Node.js (no dependencies).
 * Creates a crisp text + diamond icon logo with transparent background.
 */
const fs = require('fs');
const zlib = require('zlib');

// ── PNG encoder (minimal, transparent) ──
function createPNG(width, height, pixels) {
  const signature = Buffer.from([137, 80, 78, 71, 13, 10, 26, 10]);

  function chunk(type, data) {
    const len = Buffer.alloc(4);
    len.writeUInt32BE(data.length);
    const t = Buffer.from(type);
    const crc = crc32(Buffer.concat([t, data]));
    const c = Buffer.alloc(4);
    c.writeUInt32BE(crc >>> 0);
    return Buffer.concat([len, t, data, c]);
  }

  // IHDR
  const ihdr = Buffer.alloc(13);
  ihdr.writeUInt32BE(width, 0);
  ihdr.writeUInt32BE(height, 4);
  ihdr[8] = 8; // bit depth
  ihdr[9] = 6; // RGBA
  ihdr[10] = 0; ihdr[11] = 0; ihdr[12] = 0;

  // IDAT
  const raw = Buffer.alloc(height * (1 + width * 4));
  for (let y = 0; y < height; y++) {
    raw[y * (1 + width * 4)] = 0; // filter none
    for (let x = 0; x < width; x++) {
      const si = (y * width + x) * 4;
      const di = y * (1 + width * 4) + 1 + x * 4;
      raw[di] = pixels[si];
      raw[di + 1] = pixels[si + 1];
      raw[di + 2] = pixels[si + 2];
      raw[di + 3] = pixels[si + 3];
    }
  }
  const compressed = zlib.deflateSync(raw);

  // IEND
  const iend = chunk('IEND', Buffer.alloc(0));

  return Buffer.concat([signature, chunk('IHDR', ihdr), chunk('IDAT', compressed), iend]);
}

// CRC32 table
const crcTable = new Uint32Array(256);
for (let n = 0; n < 256; n++) {
  let c = n;
  for (let k = 0; k < 8; k++) c = (c & 1) ? (0xEDB88320 ^ (c >>> 1)) : (c >>> 1);
  crcTable[n] = c;
}
function crc32(buf) {
  let c = 0xFFFFFFFF;
  for (let i = 0; i < buf.length; i++) c = crcTable[(c ^ buf[i]) & 0xFF] ^ (c >>> 8);
  return (c ^ 0xFFFFFFFF) >>> 0;
}

// ── Drawing helpers ──
function setPixel(pixels, w, x, y, r, g, b, a) {
  x = Math.round(x); y = Math.round(y);
  if (x < 0 || y < 0 || x >= w || y >= Math.floor(pixels.length / (w * 4))) return;
  const i = (y * w + x) * 4;
  const srcA = a / 255;
  const dstA = pixels[i + 3] / 255;
  const outA = srcA + dstA * (1 - srcA);
  if (outA === 0) return;
  pixels[i] = Math.round((r * srcA + pixels[i] * dstA * (1 - srcA)) / outA);
  pixels[i + 1] = Math.round((g * srcA + pixels[i + 1] * dstA * (1 - srcA)) / outA);
  pixels[i + 2] = Math.round((b * srcA + pixels[i + 2] * dstA * (1 - srcA)) / outA);
  pixels[i + 3] = Math.round(outA * 255);
}

function fillRect(pixels, w, x, y, rw, rh, r, g, b, a) {
  for (let dy = 0; dy < rh; dy++)
    for (let dx = 0; dx < rw; dx++)
      setPixel(pixels, w, x + dx, y + dy, r, g, b, a);
}

function fillDiamond(pixels, w, cx, cy, rx, ry, r, g, b, a) {
  for (let dy = -ry; dy <= ry; dy++) {
    const halfW = Math.round(rx * (1 - Math.abs(dy) / ry));
    for (let dx = -halfW; dx <= halfW; dx++) {
      setPixel(pixels, w, cx + dx, cy + dy, r, g, b, a);
    }
  }
}

function fillCircle(pixels, w, cx, cy, radius, r, g, b, a) {
  const r2 = radius * radius;
  for (let dy = -radius; dy <= radius; dy++)
    for (let dx = -radius; dx <= radius; dx++)
      if (dx * dx + dy * dy <= r2)
        setPixel(pixels, w, cx + dx, cy + dy, r, g, b, a);
}

// ── Bitmap font (5x7 pixel font for clean rendering) ──
const FONT = {
  'A': ['01110','10001','10001','11111','10001','10001','10001'],
  'B': ['11110','10001','10001','11110','10001','10001','11110'],
  'C': ['01110','10001','10000','10000','10000','10001','01110'],
  'D': ['11100','10010','10001','10001','10001','10010','11100'],
  'E': ['11111','10000','10000','11110','10000','10000','11111'],
  'F': ['11111','10000','10000','11110','10000','10000','10000'],
  'G': ['01110','10001','10000','10111','10001','10001','01110'],
  'H': ['10001','10001','10001','11111','10001','10001','10001'],
  'I': ['01110','00100','00100','00100','00100','00100','01110'],
  'J': ['00111','00010','00010','00010','00010','10010','01100'],
  'K': ['10001','10010','10100','11000','10100','10010','10001'],
  'L': ['10000','10000','10000','10000','10000','10000','11111'],
  'M': ['10001','11011','10101','10101','10001','10001','10001'],
  'N': ['10001','11001','10101','10011','10001','10001','10001'],
  'O': ['01110','10001','10001','10001','10001','10001','01110'],
  'P': ['11110','10001','10001','11110','10000','10000','10000'],
  'Q': ['01110','10001','10001','10001','10101','10010','01101'],
  'R': ['11110','10001','10001','11110','10100','10010','10001'],
  'S': ['01111','10000','10000','01110','00001','00001','11110'],
  'T': ['11111','00100','00100','00100','00100','00100','00100'],
  'U': ['10001','10001','10001','10001','10001','10001','01110'],
  'V': ['10001','10001','10001','10001','01010','01010','00100'],
  'W': ['10001','10001','10001','10101','10101','10101','01010'],
  'X': ['10001','10001','01010','00100','01010','10001','10001'],
  'Y': ['10001','10001','01010','00100','00100','00100','00100'],
  'Z': ['11111','00001','00010','00100','01000','10000','11111'],
  'a': ['00000','00000','01110','00001','01111','10001','01111'],
  'b': ['10000','10000','10110','11001','10001','10001','11110'],
  'c': ['00000','00000','01110','10000','10000','10001','01110'],
  'd': ['00001','00001','01101','10011','10001','10001','01111'],
  'e': ['00000','00000','01110','10001','11111','10000','01110'],
  'f': ['00110','01001','01000','11100','01000','01000','01000'],
  'g': ['00000','00000','01111','10001','01111','00001','01110'],
  'h': ['10000','10000','10110','11001','10001','10001','10001'],
  'i': ['00100','00000','01100','00100','00100','00100','01110'],
  'j': ['00010','00000','00110','00010','00010','10010','01100'],
  'k': ['10000','10000','10010','10100','11000','10100','10010'],
  'l': ['01100','00100','00100','00100','00100','00100','01110'],
  'm': ['00000','00000','11010','10101','10101','10001','10001'],
  'n': ['00000','00000','10110','11001','10001','10001','10001'],
  'o': ['00000','00000','01110','10001','10001','10001','01110'],
  'p': ['00000','00000','11110','10001','11110','10000','10000'],
  'q': ['00000','00000','01101','10011','01111','00001','00001'],
  'r': ['00000','00000','10110','11001','10000','10000','10000'],
  's': ['00000','00000','01110','10000','01110','00001','11110'],
  't': ['01000','01000','11100','01000','01000','01001','00110'],
  'u': ['00000','00000','10001','10001','10001','10011','01101'],
  'v': ['00000','00000','10001','10001','10001','01010','00100'],
  'w': ['00000','00000','10001','10001','10101','10101','01010'],
  'x': ['00000','00000','10001','01010','00100','01010','10001'],
  'y': ['00000','00000','10001','10001','01111','00001','01110'],
  'z': ['00000','00000','11111','00010','00100','01000','11111'],
  '0': ['01110','10001','10011','10101','11001','10001','01110'],
  '1': ['00100','01100','00100','00100','00100','00100','01110'],
  '2': ['01110','10001','00001','00110','01000','10000','11111'],
  '3': ['01110','10001','00001','00110','00001','10001','01110'],
  '4': ['00010','00110','01010','10010','11111','00010','00010'],
  '5': ['11111','10000','11110','00001','00001','10001','01110'],
  '6': ['00110','01000','10000','11110','10001','10001','01110'],
  '7': ['11111','00001','00010','00100','01000','01000','01000'],
  '8': ['01110','10001','10001','01110','10001','10001','01110'],
  '9': ['01110','10001','10001','01111','00001','00010','01100'],
  ' ': ['00000','00000','00000','00000','00000','00000','00000'],
  '-': ['00000','00000','00000','11111','00000','00000','00000'],
  '.': ['00000','00000','00000','00000','00000','00000','00100'],
  '|': ['00100','00100','00100','00100','00100','00100','00100'],
};

function drawText(pixels, w, text, startX, startY, scale, r, g, b, a) {
  let cx = startX;
  for (const ch of text) {
    const glyph = FONT[ch];
    if (!glyph) { cx += 4 * scale; continue; }
    for (let row = 0; row < 7; row++) {
      for (let col = 0; col < 5; col++) {
        if (glyph[row][col] === '1') {
          fillRect(pixels, w, cx + col * scale, startY + row * scale, scale, scale, r, g, b, a);
        }
      }
    }
    cx += 6 * scale;
  }
  return cx;
}

function textWidth(text, scale) {
  return text.length * 6 * scale - scale;
}

// ═══════════════════════════════════════
// Generate DARK logo (for light/white backgrounds — used in emails)
// ═══════════════════════════════════════
function generateDarkLogo() {
  const W = 600, H = 100;
  const pixels = new Uint8Array(W * H * 4); // all transparent

  const iconCX = 42, iconCY = 50;

  // Diamond icon with gradient effect (blue)
  fillDiamond(pixels, W, iconCX, iconCY, 30, 40, 59, 125, 221, 240);

  // Facet highlights
  // Top-right highlight
  for (let dy = -38; dy < 0; dy++) {
    const halfW = Math.round(28 * (1 - Math.abs(dy) / 40));
    for (let dx = 0; dx <= halfW; dx++) {
      setPixel(pixels, W, iconCX + dx, iconCY + dy, 90, 156, 245, 100);
    }
  }

  // Bottom-left shadow
  for (let dy = 0; dy <= 38; dy++) {
    const halfW = Math.round(28 * (1 - Math.abs(dy) / 40));
    for (let dx = -halfW; dx <= 0; dx++) {
      setPixel(pixels, W, iconCX + dx, iconCY + dy, 30, 80, 180, 60);
    }
  }

  // Inner diamond accent
  fillDiamond(pixels, W, iconCX + 5, iconCY - 3, 8, 10, 255, 255, 255, 80);

  // Small circle accent
  fillCircle(pixels, W, iconCX - 8, iconCY - 6, 4, 255, 255, 255, 60);

  // "NFT MARKETPLACE" subtitle (small, gray)
  drawText(pixels, W, 'NFT MARKETPLACE', 88, 14, 2, 107, 114, 128, 160);

  // "artist" in bold dark
  const x1 = drawText(pixels, W, 'artist', 88, 42, 4, 26, 26, 46, 255);
  // "to" in lighter weight
  const x2 = drawText(pixels, W, 'to', x1 + 4, 42, 4, 107, 114, 128, 200);
  // "collectors" in bold dark
  drawText(pixels, W, 'collectors', x2 + 4, 42, 4, 26, 26, 46, 255);

  return createPNG(W, H, pixels);
}

// ═══════════════════════════════════════
// Generate WHITE logo (for dark backgrounds — sidebar)
// ═══════════════════════════════════════
function generateWhiteLogo() {
  const W = 600, H = 100;
  const pixels = new Uint8Array(W * H * 4);

  const iconCX = 42, iconCY = 50;

  fillDiamond(pixels, W, iconCX, iconCY, 30, 40, 255, 255, 255, 240);

  for (let dy = -38; dy < 0; dy++) {
    const halfW = Math.round(28 * (1 - Math.abs(dy) / 40));
    for (let dx = 0; dx <= halfW; dx++) {
      setPixel(pixels, W, iconCX + dx, iconCY + dy, 255, 255, 255, 60);
    }
  }
  for (let dy = 0; dy <= 38; dy++) {
    const halfW = Math.round(28 * (1 - Math.abs(dy) / 40));
    for (let dx = -halfW; dx <= 0; dx++) {
      setPixel(pixels, W, iconCX + dx, iconCY + dy, 200, 200, 220, 40);
    }
  }

  fillDiamond(pixels, W, iconCX + 5, iconCY - 3, 8, 10, 59, 125, 221, 80);
  fillCircle(pixels, W, iconCX - 8, iconCY - 6, 4, 59, 125, 221, 60);

  drawText(pixels, W, 'NFT MARKETPLACE', 88, 14, 2, 255, 255, 255, 140);
  const x1 = drawText(pixels, W, 'artist', 88, 42, 4, 255, 255, 255, 255);
  const x2 = drawText(pixels, W, 'to', x1 + 4, 42, 4, 255, 255, 255, 160);
  drawText(pixels, W, 'collectors', x2 + 4, 42, 4, 255, 255, 255, 255);

  return createPNG(W, H, pixels);
}

// ═══════════════════════════════════════
// Generate small icon (favicon-style, 64x64)
// ═══════════════════════════════════════
function generateSmallIcon() {
  const W = 64, H = 64;
  const pixels = new Uint8Array(W * H * 4);

  fillDiamond(pixels, W, 32, 32, 24, 30, 59, 125, 221, 240);

  for (let dy = -28; dy < 0; dy++) {
    const halfW = Math.round(22 * (1 - Math.abs(dy) / 30));
    for (let dx = 0; dx <= halfW; dx++) {
      setPixel(pixels, W, 32 + dx, 32 + dy, 90, 156, 245, 100);
    }
  }

  fillDiamond(pixels, W, 36, 28, 6, 8, 255, 255, 255, 80);
  fillCircle(pixels, W, 26, 26, 3, 255, 255, 255, 60);

  return createPNG(W, H, pixels);
}

// ── Write files ──
const outDir = 'public';

fs.writeFileSync(`${outDir}/images/logo.png`, generateDarkLogo());
fs.writeFileSync(`${outDir}/homepage/images/logo-dark.png`, generateDarkLogo());
fs.writeFileSync(`${outDir}/assets/images/logo-dark.png`, generateDarkLogo());
fs.writeFileSync(`${outDir}/assets/images/logo-white.png`, generateWhiteLogo());
fs.writeFileSync(`${outDir}/admin/logo.png`, generateDarkLogo());
fs.writeFileSync(`${outDir}/admin/dashboard/logo.png`, generateDarkLogo());
fs.writeFileSync(`${outDir}/images/favicon.png`, generateSmallIcon());

console.log('All PNG logos generated successfully!');
console.log('Files:');
console.log('  public/images/logo.png (600x100, dark text, transparent bg)');
console.log('  public/homepage/images/logo-dark.png (600x100, dark text)');
console.log('  public/assets/images/logo-dark.png (600x100, dark text)');
console.log('  public/assets/images/logo-white.png (600x100, white text)');
console.log('  public/admin/logo.png (600x100, dark text)');
console.log('  public/admin/dashboard/logo.png (600x100, dark text)');
console.log('  public/images/favicon.png (64x64, icon only)');
