// resources/js/utils/countup.js

export class CountUp {
    constructor(target, startVal, endVal, decimals = 0, duration = 2, options = {}) {
        this.options = Object.assign({
            useEasing: true,
            useGrouping: false,
            separator: ',',
            decimal: '.',
            prefix: '',
            suffix: ''
        }, options);

        this.d = typeof target === 'string' ? document.getElementById(target) : target;
        this.startVal = Number(startVal);
        this.endVal = Number(endVal);
        this.countDown = this.startVal > this.endVal;
        this.frameVal = this.startVal;
        this.decimals = Math.max(0, decimals);
        this.dec = Math.pow(10, this.decimals);
        this.duration = Number(duration) * 1000 || 2000;
        this.paused = false;
    }

    printValue(value) {
        const result = this.formatNumber(value);
        if (this.d.tagName === 'INPUT') {
            this.d.value = result;
        } else {
            this.d.textContent = result;
        }
    }

    easeOutExpo(t, b, c, d) {
        return c * (-Math.pow(2, -10 * t / d) + 1) * 1024 / 1023 + b;
    }

    count = (timestamp) => {
        if (!this.startTime) this.startTime = timestamp;
        const progress = timestamp - this.startTime;
        this.remaining = this.duration - progress;

        if (this.options.useEasing) {
            this.frameVal = this.countDown
                ? this.startVal - this.easeOutExpo(progress, 0, this.startVal - this.endVal, this.duration)
                : this.easeOutExpo(progress, this.startVal, this.endVal - this.startVal, this.duration);
        } else {
            this.frameVal = this.countDown
                ? this.startVal - ((this.startVal - this.endVal) * (progress / this.duration))
                : this.startVal + (this.endVal - this.startVal) * (progress / this.duration);
        }

        this.frameVal = this.countDown
            ? Math.max(this.frameVal, this.endVal)
            : Math.min(this.frameVal, this.endVal);

        this.frameVal = Math.round(this.frameVal * this.dec) / this.dec;
        this.printValue(this.frameVal);

        if (progress < this.duration) {
            this.rAF = requestAnimationFrame(this.count);
        } else {
            if (this.callback) this.callback();
        }
    }

    start(callback) {
        this.callback = callback;
        this.rAF = requestAnimationFrame(this.count);
    }

    update(newEndVal) {
        cancelAnimationFrame(this.rAF);
        this.paused = false;
        delete this.startTime;
        this.startVal = this.frameVal;
        this.endVal = Number(newEndVal);
        this.countDown = this.startVal > this.endVal;
        this.rAF = requestAnimationFrame(this.count);
    }

    reset() {
        this.paused = false;
        delete this.startTime;
        this.frameVal = this.startVal;
        cancelAnimationFrame(this.rAF);
        this.printValue(this.startVal);
    }

    formatNumber(nStr) {
        nStr = nStr.toFixed(this.decimals);
        let [x1, x2] = nStr.split('.');
        x2 = x2 ? this.options.decimal + x2 : '';
        if (this.options.useGrouping) {
            x1 = x1.replace(/\B(?=(\d{3})+(?!\d))/g, this.options.separator);
        }
        return this.options.prefix + x1 + x2 + this.options.suffix;
    }
}
