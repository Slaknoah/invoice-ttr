<template>
    <transition-group 
        :tag="parentTag"
        @before-enter="beforeEnter"
        @enter="enter"
        @after-enter="afterEnter"
        @before-leave="beforeLeave"
        @leave="leave"
        @after-leave="afterLeave"
        >
        <slot></slot>
    </transition-group>
</template>

<script>
import { gsap } from "gsap";
export default {
    data() {
        return {
            isAnimating: false,
            justLeft:  false,
        }
    },
    props: { parentTag: String, numItems: Number, animateBack: Boolean, previousQuantity: Number },
    methods: {
        beforeEnter(el) {
            el.style.opacity = 0;
            el.style.transform = "translate(0 -50px)";

            if(!this.isAnimating) {
                this.isAnimating = true;
                this.$emit('animating');
            }
        },
        enter(el, done) {
            let delay = (el.dataset.index > 10 ? 10 : el.dataset.index ) * 80;
            // if(this.justLeft) {
            //     delay += (100 * this.previousQuantity);
            // }

            setTimeout(() => {
                gsap.to(el, 0.5, {
                    opacity: 1,
                    y: 0, 
                    onComplete: done
                })
            }, delay);
        },
        afterEnter(el) {
            if (+el.dataset.index === this.numItems - 1) {
                this.isAnimating = false;
                this.$emit('stoppedAnimating');
            }
        },
        beforeLeave() {
            if(!this.isAnimating) {
                this.isAnimating = true;
                this.$emit('animating');
            }
            this.justLeft = true;
        },
        leave(el, done) {
            const delay = el.dataset.index * 50;

            setTimeout(() => {
                gsap.to(el, 0.5, {
                    opacity: 0,
                    x: (this.animateBack) ? 50 : -50, 
                    onComplete: done
                })
            }, delay);
        },
        afterLeave(el) {
            el.style.opacity = 0;
            el.style.display = "none";

            if (+el.dataset.index === this.numItems - 1) {
                this.isAnimating = false;
                this.$emit('stoppedAnimating');
            }
            this.justLeft = true;
        }
    },
}
</script>