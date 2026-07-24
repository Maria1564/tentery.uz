let docWidth = document.documentElement.clientWidth;
window.addEventListener('resize', e => {
    docWidth = document.documentElement.clientWidth;
});
window.addEventListener('dragstart', e => {
    if((e.target.tagName == 'A') || (e.target.tagName == 'IMG') ) {
       e.preventDefault();
    }
});

const set_100vh_var = () => {
    document.documentElement.style.setProperty('--vh', `${window.innerHeight/100}px`);
};
window.addEventListener('resize', set_100vh_var);
window.addEventListener('orientationchange', set_100vh_var);
setTimeout( set_100vh_var, 50);

const setSingleCategoryCardHeight = () => {
    const card = document.querySelector('.single-categories-content .category-form');
    if (!card) return;

    if (window.matchMedia('(max-width: 1024px)').matches) {
        card.style.removeProperty('--single-category-card-height');
        return;
    }

    const rect = card.getBoundingClientRect();
    const bottomGap = 16;
    const minHeight = 320;
    const availableHeight = Math.max(minHeight, window.innerHeight - Math.max(rect.top, 0) - bottomGap);

    card.style.setProperty('--single-category-card-height', `${availableHeight}px`);
};

window.addEventListener('resize', setSingleCategoryCardHeight);
window.addEventListener('orientationchange', setSingleCategoryCardHeight);
window.addEventListener('scroll', setSingleCategoryCardHeight, { passive: true });
window.addEventListener('load', setSingleCategoryCardHeight);
document.addEventListener('DOMContentLoaded', setSingleCategoryCardHeight);
setTimeout(setSingleCategoryCardHeight, 100);

Fancybox.bind('[data-fancybox]', {
    on: {
        done: function(fancybox, slide) {
            const targetInputAdd = document.querySelector('.modal-call input[name=additional-frombuttons]');
            targetInputAdd.value = '';
            if (slide.caption) {
                targetInputAdd.value = slide.caption
            }
        },
        close: (fancybox) => {
            let body = document.querySelector('body');
            body.classList.remove('body-lock');
            body.style.paddingRight = '0px';            
        },
    },
});

Fancybox.bind('[data-fancybox-video]', {
    on: {
        done: function(fancybox, slide) {
            const targetInputAdd = document.querySelector('.modal-call input[name=additional-frombuttons]');
            targetInputAdd.value = '';
            if (slide.caption) {
                targetInputAdd.value = slide.caption
            }
        },
        close: (fancybox) => {
            document.querySelector("#promo video").pause();  
			console.log("close");
			let body = document.querySelector('body');
            body.classList.remove('body-lock');
            body.style.paddingRight = '0px'; 			
        },
    },
});

const siteMenu = new Menu;
const siteNav = new FixNav;
const siteToggle = new ToggleDown(true);

const toggleNav = (e, cb, nav) => {
    if (e.currentTarget.closest('.selected')) return;
    const target = e.currentTarget.dataset.id;
    cb(target);

    nav.querySelector('.selected').classList.remove('selected');
    e.currentTarget.classList.add('selected');
} 

if (document.querySelector('.categories__slider')) {
    const classEl = '.categories__slider';
    const categoriesSlider = new Swiper(classEl, {
        slidesPerView: "auto",
        spaceBetween: 10,
        breakpoints: {
            1281: {
                slidesPerView: 4,
            },
            481: {
                spaceBetween: 0,
            },
        }
    });

    const changeVisibleSlids = id => {
        parentSection.querySelectorAll('.js-itemCats').forEach(slide => {
            const slideCats = slide.dataset.category;
            if (!slideCats.includes(id)) {
                slide.style.display = 'none'
            } else {
                slide.style.display = ''
            }
        });
        categoriesSlider.update()
    }

    const parentSection = document.querySelector('.categories');
    const firstChild = parentSection.querySelector('.categories__nav .js-toggleCats');
    const firstValue = firstChild.dataset.id;
    firstChild.classList.add('selected');

    changeVisibleSlids(firstValue);

    parentSection.querySelectorAll('.js-toggleCats').forEach(btn => {
        btn.addEventListener('click', e => toggleNav(e, changeVisibleSlids, parentSection.querySelector('.categories__nav')));
    })
}

if (document.querySelector('.options') ) {
    const options = document.querySelectorAll('.options__pointer');

    const setPositionOptions = () => {
        const firstEl = document.querySelector('.options__pointer-txt');
        if (firstEl)
		{
			firstEl.style.opacity = 0;
			firstEl.style.display = "block";

			const sizeCard = firstEl.clientWidth / 2;

			setTimeout(() => {
				firstEl.style.opacity = '';
				firstEl.style.display = '';
			}, 300)

			options.forEach(option => {
				const coords = option.getBoundingClientRect();
				const pointerCard = option.querySelector('.options__pointer-txt');
				if (coords.left < sizeCard) {

					pointerCard.style.left = `${sizeCard - 20}px`;
				} else if ((docWidth - coords.left) < sizeCard) {
					pointerCard.style.left = `-${sizeCard - 40}px`;
				}
			})
		}
    }
    setPositionOptions();

    if (docWidth < 769) {
        const classEl = '.options__slider';
        const categoriesSlider = new Swiper(classEl, {
            slidesPerView: "auto"
        });
    }
}

    // Главная - карта и слайдер
const tabsSite = document.querySelectorAll('[data-tabs-target]');
if (tabsSite) {
    tabsSite.forEach( tab => new siteTabs(tab) );
}

const sectionWorks = document.querySelector('.works');
if (sectionWorks) {

    if(document.querySelector('.works__slider')) {
        const classEl = '.works__slider';
        document.querySelector(classEl).style.marginRight = -( (docWidth - document.querySelector('.grid').clientWidth ) / 2 + 20) + 'px'
        const worksSlider = new Swiper(classEl, {
            slidesPerView: "auto",
            spaceBetween: 10,
            navigation: {
                prevEl: ".works .button-slider--prev",
                nextEl: ".works .button-slider--next",
            },
            breakpoints: {
                481: {
                    spaceBetween:  20,
                },
            }
        });
    }

    const workMap = new siteMap('works-map', true);
}

    // Карта на архиве работ
const archiveWorksList = document.querySelector('.archive-works');
if (archiveWorksList) {
    //const archiveWorkTabs = new siteTabs('.archive-works-nav');
    if(document.querySelector('.archive-works-nav')) {
        const archiveWorkMap = new siteMap('works-map', true, (locations) => {
            if (locations.length > 0) document.querySelector('.archive-works-nav').style.display = 'flex';
        });        
    }
}

if (document.querySelector('.solutions__slider')) {
    const classEl = '.solutions__slider';
    document.querySelector(classEl).style.marginRight = -( (docWidth - document.querySelector('.grid').clientWidth ) / 2 + 20) + 'px'
    const categoriesSlider = new Swiper(classEl, {
        slidesPerView: "auto",
        spaceBetween: 10,
        navigation: {
          prevEl: ".solutions .button-slider--prev",
          nextEl: ".solutions .button-slider--next",
        },
        breakpoints: {
            481: {
                spaceBetween:  20,
            },
        }
    });
}

if (document.querySelector('.home-services__slider')) {
    const classEl = '.home-services__slider';
    const servicesSlider = new Swiper(classEl, {
        slidesPerView: "auto",
        spaceBetween: 10,
        breakpoints: {
            1281: {
                slidesPerView: 5,
            },
            769: {
                slidesPerView: "auto",
                spaceBetween:  20,
            },
        }
    });

}

if (document.querySelector('.gallery__slider')) {
    const classEl = '.gallery__slider';
    document.querySelector(classEl).style.marginRight = -( (docWidth - document.querySelector('.grid').clientWidth ) / 2 + 20) + 'px'
    const gallerySlider = new Swiper(classEl, {
        slidesPerView: "auto",
        spaceBetween: 10,
        navigation: {
          prevEl: ".gallery .button-slider--prev",
          nextEl: ".gallery .button-slider--next",
        },
        breakpoints: {
            481: {
                spaceBetween:  20,
            },
        }
    });
}

if (document.querySelector('.b-gallery__slider') ) {
    let gallerySlider;
    const classEl = '.b-gallery__slider';

    const toggleSlider = () => {
        if (docWidth < 861) {

            if (!gallerySlider) {
                categoriesSlider = new Swiper(classEl, {
                    slidesPerView: "auto",
                    //spaceBetween: 10
                }); 
            }
        } else {
            if (gallerySlider) {
                gallerySlider.destroy();
            }  
        }
    }
    window.addEventListener('resize', toggleSlider);
    toggleSlider();
}

const toggleBlockMobile = (e, elClass) => {
    e.preventDefault();
    if ( docWidth > 1024 ) return;
    
    const content = e.currentTarget.nextElementSibling;
    e.currentTarget.closest(`.${elClass}`).classList.toggle(`${elClass}--selected`);
    content.style.maxHeight = (content.style.maxHeight) ? null : (content.scrollHeight + 'px');
}
// Toggle menu для мобилок
const menuParentlinks = document.querySelectorAll('.header__sidebar .has-child > a');
if (menuParentlinks) {
    menuParentlinks.forEach(parent => {
        parent.addEventListener('click', e => toggleBlockMobile(e, 'has-child'))
    })    
}

// Toggle в сайдбаре email
const mailMoibileTitle = document.querySelector('.header__mailTitle-sub');
if (mailMoibileTitle) {
    mailMoibileTitle.addEventListener('click', e => toggleBlockMobile(e, 'header__mail'))
}

// Карта в контактах
if( document.querySelector('.contacts-map__map') ) {
    const contactsMap = new siteMap('contacts-map__map');
}

const buttonsShowMore = document.querySelectorAll('[data-more-target]');
if(buttonsShowMore.length) {
    buttonsShowMore.forEach(button => {
        button.addEventListener('click', e => {
            e.preventDefault();
            const textNew = button.dataset.moreText;
            const textCurrent = button.innerHTML;
            const target = button?.dataset.moreTarget;
            if (!target) return

            let targetEl = document.querySelector(`[data-more-list='${target}']`);
            if (!targetEl) return;

            targetEl.classList.toggle('show');
            button.innerHTML = textNew;
            button.dataset.moreText = textCurrent;   
        })        
    })
}
