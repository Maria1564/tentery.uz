class Menu {
    constructor() {
        this.buttons = document.querySelectorAll('.js-toggleMenu');
        this.toggle = this.toggle.bind(this);
        this.buttons.forEach(btn => btn.addEventListener('click', this.toggle ))
        document.addEventListener('click', e => {
            if ( e.target.closest('.header__sidebar') || e.target.closest('.js-toggleMenu') ) return;
            if ( document.querySelector('.header__sidebar--active') ) {
                this.toggle();
            }
        });
    }
    toggle() {
        let toggleMenu = ''
        toggleMenu = 'header__sidebar';

        const elMenu = document.querySelector(`.${toggleMenu}`);

        const action =  elMenu.classList.contains(`${toggleMenu}--active`)?'remove':'add';
        elMenu.classList[action](`${toggleMenu}--active`);
        this.buttons.forEach(el => el.classList[action]('button-bar--active'));

        document.querySelector('body').classList[action]('body-lock');        
        document.querySelector('body').classList[action]('show-sidebar');
    }
}

class FixNav {
    constructor() {
        document.addEventListener('scroll', this.toggle)
        this.toggle();
    }
    toggle() {
        const action = (window.pageYOffset > 10) ? 'add' : 'remove';
        document.querySelector('.header').classList[action]('header--fixed');
    }
}

class ToggleDown {
    constructor(isSingle = false) {
        this.buttons = document.querySelectorAll('.toggle-list__button');
        this.buttons.forEach(el => el.addEventListener('click', e => this.toggle(e, this)));
        this.isSingle = isSingle;
        this.classActive = 'toggle-list__item--active';
        this.classContent = 'toggle-list__content';
        this.pageY = 0;
    }
    toggle(e, obj) {
        let parent = e.target.closest('.toggle-list__item');
        let content = parent.querySelector(`.${this.classContent}`);
        if (!content) return;

        obj.height(content);

        if(!this.isSingle) {
            parent.classList.toggle(this.classActive)
        } else {
            let action = parent.classList.contains(this.classActive) ? 'remove' : 'add';
            if (action !== 'remove') {
                this.removePrev(parent, obj);
                this.pageY = window.scrollY;
            }
            parent.classList[action](this.classActive);
        
        }
    }
    removePrev(parent, obj) {
        let previous = parent.closest('.toggle-list').querySelector(`.${this.classActive}`);
        if (previous) {
            previous.classList.remove(this.classActive);
            obj.height(previous.querySelector(`.${this.classContent}`));
            window.scrollTo({top: this.pageY});
            this.pageY = 0;
        }
    }
    height(content) {
        content.style.maxHeight = (content.style.maxHeight)
            ? null : (content.scrollHeight + 'px');
    }
}

class siteMap {
    constructor(id, isGetLocations, cb) {
        this.yMap = '';
        this.id = id;
        this.isGetLocations = isGetLocations;
        this.element = document.querySelector(`.${id}`);
        this.cb = cb;
        if (!this.element || !this.element?.dataset?.map) return; 
        const props = JSON.parse(this.element?.dataset?.map);
        this.create(props);
    }
    create({coords, pointer, address, zoom}) {
        let locations;
        let isBallon = false;
        let mapZoom = zoom && Number.isInteger(+zoom) ? zoom : 11;
        if (!Array.isArray(coords) || coords.length < 2) return;

        ymaps.ready(() => {
            locations = (this.isGetLocations)
                ?  this.getCoords('card-work')
                : [{coords, pointer, address}];

            if (!locations.length) return;

            this.yMap = new ymaps.Map(this.id, {
                center: coords,
                zoom: mapZoom,
                controls: ['zoomControl']
            });
            this.yMap.behaviors.disable('scrollZoom');

            if (this.isGetLocations) {
                isBallon = true;     
            }

            ymaps.geoQuery( this.createPlacemarks(locations, pointer, isBallon) ).addToMap(this.yMap);
        });
    }    
    createPlacemarks(locations, pointer, isBallon) {
        const attrPlacemark = {
            iconLayout: 'default#image',
            iconImageSize: [28, 28],
            iconImageOffset: [-14, -14],
            hideIconOnBalloonOpen: false,
            preset: 'islands#redDotIcon'
        }
        if (pointer) {
            attrPlacemark.iconImageHref = pointer;
        }

        return locations.map(({address, coords, describe, link}) => {
            let optionsPlacemark = {
                balloonContent: describe || address,
                hintContent: describe || address,
            };
            if (isBallon) {
                optionsPlacemark.balloonContentBody = `<a href="${link}" target=_blank class="card-ballonWork">${describe}</a>`
            }
            return new ymaps.Placemark(coords, optionsPlacemark, attrPlacemark);
        });
    }
    getCoords(card) {
        const locations = [];
        document.querySelectorAll(`.${card}`).forEach(work => {
            const { coords, address } = JSON.parse(work?.dataset?.map);
            
            if (!Array.isArray(coords) || coords.length < 2) {
                return;
            }

            const describe = work.querySelector(`.${card}__title`).innerHTML;
            const link = work.href;
            locations.push({coords, describe, link, address})
        });

        if (this.cb) {
            this.cb(locations);
        }       

        return locations;
    }
}

class siteTabs {
    constructor(target) {
        // this.tabsNav = document.querySelector(target);
        this.tabsNav = target;
        const tabsTargetSelector = this.tabsNav?.dataset.tabsTarget;
        if (tabsTargetSelector) {
            this.tabsTarget = document.querySelector(tabsTargetSelector);
        }
        this.setup();

        this.tabsNav?.querySelectorAll('[data-tabs-id]').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                if (e.currentTarget.closest('.selected')) return;

                this.tabsNav.querySelector('.selected').classList.remove('selected');
                e.currentTarget.classList.add('selected');

                this.changeActiveTab(e.currentTarget.dataset.tabsId)
            });
        })
    }
    setup() {
        if (this.tabsNav) {
            const firstElNav = this.tabsNav.querySelector('[data-tabs-id]');
            if (firstElNav) {
                firstElNav.classList.add('selected');
            }            
        }
        
        if (this.tabsTarget) {
            const firstElTab = this.tabsTarget.querySelector('[data-tabs-item]');
            if (!firstElTab) return;
            firstElTab.classList.add('selected');            
        }
    }
    changeActiveTab(id) {
        this.tabsTarget.querySelector('.selected[data-tabs-item]').classList.remove('selected');
        this.tabsTarget.querySelector(`[data-tabs-item="${id}"]`).classList.add('selected');
    }
}

