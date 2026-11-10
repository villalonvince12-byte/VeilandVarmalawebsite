<style>
        /* Testimonials */
        .testimonials {
              
            padding: 8rem 3rem;
            text-align: center;
        }
          .testimonials-header {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        /* When active (in viewport) */
        .testimonials-header.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* h2 animation */
        .testimonials-header h2.testimonials-title {
            font-family: 'modernline - Personal Use', sans-serif;
            font-size: 1.5rem;
            margin: 0;
            white-space: nowrap;
            top: -160px;
            position: relative;
            z-index: 2;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
            left: 15px;
        }
        
        .testimonials-header h2 {
            font-size: 2.5rem;
            margin: 0;
            white-space: nowrap;
            top: -160px;
            position: relative;
            z-index: 1;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        /* line animation */
        .testimonials-header-line {
            height: 1px;
            background-color: var(--textcolor);
            flex-grow: 1;
            top: -160px;
            position: relative;
            opacity: 0;
            transform: scaleX(0);
            transform-origin: left;
            transition: opacity 0.8s ease 0.3s, transform 0.8s ease 0.3s;
        }

        /* When section is active, animate h2 and line */
        .testimonials-header.active h2 {
            opacity: 1;
            transform: translateY(0);
        }

        .testimonials-header.active .testimonials-header-line {
            opacity: 1;
            transform: scaleX(1);
        }

        /* Keyframes */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes lineReveal {
            to {
                opacity: 1;
                transform: scaleX(1);
            }
        }

        .testimonial-slider {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .testimonial {
            display: none;
            animation: fade 1s ease;
        }
        
        @keyframes fade {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .testimonial.active {
            display: block;
        }
        
        .testimonial-text {
            font-size: 1.5rem;
            font-style: italic;
            margin-bottom: 2rem;
            line-height: 1.8;
        }
        
        .testimonial-author {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
        }
        
        .testimonial-nav {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 3rem;
        }
        
        .testimonial-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--tertiary);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .testimonial-dot.active {
            background: var(--secondary);
        }
         /* mobile view Section for testimonials */
@media (max-width: 956px) {
  .testimonials {
    padding: 4rem 1.5rem;
  }

  .testimonial-text {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    padding: 0 0.5rem;
  }

  .testimonial-author {
    font-size: 0.8rem;
    line-height: 1.4;
    padding: 0 0.5rem;
  }

  .testimonial-nav {
    gap: 0.7rem;
    margin-top: 2rem;
  }

  .testimonial-dot {
    width: 8px;
    height: 8px;
  }
}

@media (max-width: 480px) {
  .testimonial-text {
    font-size: 1rem;
    margin-bottom: 1.2rem;
  }

  .testimonial-author {
    font-size: 0.75rem;
  }

  .testimonial-nav {
    margin-top: 1.5rem;
  }
  .testimonial-slider {
  padding: 0 1rem;
}
.testimonials {
      padding: 5rem 1.5rem;
}
}

</style>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="testimonials-header">
            <h2 class="testimonials-title">their</h2>
            <h2>TESTIMONIALS</h2>
            <div class="testimonials-header-line"></div>
        </div>
        <div class="testimonial-slider">
            <div class="testimonial active">
                <div class="testimonial-text">
                    "Veil & Varmala has an extraordinary ability to capture not just images, but emotions and stories. Working with them was a transformative experience for our brand."
                </div>
                <div class="testimonial-author">
                    — Priya Sharma, Creative Director at Studio Naya
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-text">
                    "The photographs from our wedding don't just show what happened - they perfectly encapsulate how it felt. These images will be treasured for generations."
                </div>
                <div class="testimonial-author">
                    — Rahul & Ananya Kapoor
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-text">
                    "Veil & Varmala's artistic vision brought depth and nuance to our campaign that we couldn't have achieved with anyone else. Their work is simply magical."
                </div>
                <div class="testimonial-author">
                    — Michael Chen, Marketing Director at Linen & Co.
                </div>
            </div>
            <div class="testimonial-nav">
                <div class="testimonial-dot active" data-slide="0"></div>
                <div class="testimonial-dot" data-slide="1"></div>
                <div class="testimonial-dot" data-slide="2"></div>
            </div>
        </div>
    </section>
    