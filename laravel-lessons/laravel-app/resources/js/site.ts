const NAV_OPEN_ATTR = 'data-site-nav-open';
const DROPDOWN_OPEN_ATTR = 'data-site-nav-dropdown-open';

const initSiteNavigation = () => {
  const header = document.querySelector<HTMLElement>('[data-site-nav]');
  const toggleButton = header?.querySelector<HTMLButtonElement>('[data-site-nav-toggle]');
  const nav = header?.querySelector<HTMLElement>('.site-nav');
  const dropdownTriggers = header?.querySelectorAll<HTMLElement>('[data-site-nav-dropdown]');

  if (!header || !toggleButton || !nav) return;

  const closeNav = () => {
    header.setAttribute(NAV_OPEN_ATTR, 'false');
    toggleButton.setAttribute('aria-expanded', 'false');
  };

  const openNav = () => {
    header.setAttribute(NAV_OPEN_ATTR, 'true');
    toggleButton.setAttribute('aria-expanded', 'true');
  };

  toggleButton.addEventListener('click', () => {
    const isOpen = header.getAttribute(NAV_OPEN_ATTR) === 'true';
    if (isOpen) {
      closeNav();
    } else {
      openNav();
    }
  });

  nav.querySelectorAll<HTMLAnchorElement>('a').forEach((link) => {
    link.addEventListener('click', () => {
      if (window.matchMedia('(max-width: 960px)').matches) {
        closeNav();
      }
    });
  });

  dropdownTriggers?.forEach((button) => {
    const parentItem = button.closest<HTMLElement>('.site-nav__item--dropdown');
    const dropdown = parentItem?.querySelector<HTMLElement>('.site-nav__dropdown');

    if (!parentItem || !dropdown) return;

    const closeDropdown = () => {
      parentItem.setAttribute(DROPDOWN_OPEN_ATTR, 'false');
      button.setAttribute('aria-expanded', 'false');
    };

    const openDropdown = () => {
      parentItem.setAttribute(DROPDOWN_OPEN_ATTR, 'true');
      button.setAttribute('aria-expanded', 'true');
    };

    button.addEventListener('click', (event) => {
      event.stopPropagation();
      const isOpen = parentItem.getAttribute(DROPDOWN_OPEN_ATTR) === 'true';
      if (isOpen) {
        closeDropdown();
      } else {
        dropdownTriggers.forEach((otherButton) => {
          if (otherButton === button) return;
          const otherParent = otherButton.closest<HTMLElement>('.site-nav__item--dropdown');
          otherParent?.setAttribute(DROPDOWN_OPEN_ATTR, 'false');
          otherButton.setAttribute('aria-expanded', 'false');
        });
        openDropdown();
      }
    });
  });

  document.addEventListener('click', (event) => {
    if (!header.contains(event.target as Node)) {
      closeNav();
      dropdownTriggers?.forEach((button) => {
        const parent = button.closest<HTMLElement>('.site-nav__item--dropdown');
        parent?.setAttribute(DROPDOWN_OPEN_ATTR, 'false');
        button.setAttribute('aria-expanded', 'false');
      });
    }
  });

  window.addEventListener('resize', () => {
    if (!window.matchMedia('(max-width: 960px)').matches) {
      header.setAttribute(NAV_OPEN_ATTR, 'false');
      toggleButton.setAttribute('aria-expanded', 'false');
    }
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initSiteNavigation);
} else {
  initSiteNavigation();
}

export default initSiteNavigation;
