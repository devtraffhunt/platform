export function initPreloader() {
  window.addEventListener('load', () => {
    const images = Array.from(document.images);
    const backgroundImages = Array.from(document.querySelectorAll('*'))
      .map(el => getComputedStyle(el).backgroundImage)
      .filter(src => src !== 'none')
      .map(src => {
        const url = src.match(/url\(["']?([^"')]+)["']?\)/);
        return url ? url[1] : null;
      })
      .filter(Boolean)
      .map(src => {
        const img = new Image();
        img.src = src;
        return img;
      });

    const allImages = images.concat(backgroundImages);

    let loaded = 0;

    if (allImages.length === 0) {
      removePreloader();
      return;
    }

    allImages.forEach(img => {
      const done = () => {
        loaded++;
        if (loaded === allImages.length) {
          removePreloader();
        }
      };
      if (img.complete) {
        done();
      } else {
        img.onload = done;
        img.onerror = done;
      }
    });
  });
}

function removePreloader() {
  document.querySelectorAll('.preloader').forEach(el => {
    el.classList.add('preloader-remove');
    setTimeout(() => el.remove(), 500); // optional: remove from DOM
  });
}
