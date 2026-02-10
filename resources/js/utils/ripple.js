export function initRipple(selector = '.ripple', options = {}) {
  const defaultOptions = {
    debug: false,
    on: 'mousedown',
    opacity: 0.4,
    color: 'auto',
    multi: false,
    duration: 0.7,
    rate: (pxPerSecond) => pxPerSecond,
    easing: 'linear',
  };

  const config = { ...defaultOptions, ...options };

  const log = (...args) => {
    if (config.debug) console.log('[ripple]', ...args);
  };

  document.addEventListener(config.on, (e) => {
    const target = e.target.closest(selector);
    if (!target) return;

    target.classList.add('has-ripple');

    let ripple;

    if (config.multi || (!config.multi && !target.querySelector('.ripple'))) {
      ripple = document.createElement('span');
      ripple.className = 'ripple';
      target.appendChild(ripple);

      const size = Math.max(target.offsetWidth, target.offsetHeight);
      ripple.style.width = ripple.style.height = `${size}px`;
      log('Create ripple size:', size);

      const rate = size / config.duration;
      const filteredRate = config.rate(rate);
      const newDuration = size / filteredRate;

      if (config.duration.toFixed(2) !== newDuration.toFixed(2)) {
        config.duration = newDuration;
      }

      const color = config.color === 'auto'
        ? getComputedStyle(target).color
        : config.color;

      ripple.style.animationDuration = `${config.duration}s`;
      ripple.style.animationTimingFunction = config.easing;
      ripple.style.background = color;
      ripple.style.opacity = config.opacity;
    }

    if (!config.multi) {
      ripple = target.querySelector('.ripple');
    }

    ripple.classList.remove('ripple-animate');

    const rect = target.getBoundingClientRect();
    const x = e.pageX - rect.left - ripple.offsetWidth / 2 - window.scrollX;
    const y = e.pageY - rect.top - ripple.offsetHeight / 2 - window.scrollY;

    if (config.multi) {
      ripple.addEventListener('animationend', () => {
        ripple.remove();
      }, { once: true });
    }

    ripple.style.left = `${x}px`;
    ripple.style.top = `${y}px`;
    ripple.classList.add('ripple-animate');
  });
}
