const NAV_OPEN_ATTR = 'data-site-nav-open';
const DROPDOWN_OPEN_ATTR = 'data-site-nav-dropdown-open';
const PLATFORM_NAV_OPEN_ATTR = "data-platform-nav-open";

const PLATFORM_TOGGLE_ICONS: Record<"menu" | "x", string> = {
    menu: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>',
    x: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"></line><line x1="6" x2="18" y1="6" y2="18"></line></svg>',
};

declare global {
    interface Window {
        lucide?: {
            createIcons: () => void;
        };
    }
}

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

const initPlatformNav = () => {
    const root = document.querySelector<HTMLElement>("[data-platform-nav]");
    if (!root) return;

    const toggle = root.querySelector<HTMLButtonElement>(
        "[data-platform-nav-toggle]"
    );
                                                                                                const overlay = root.querySelector<HTMLElement>(
        "[data-platform-nav-overlay]"
    );
    const drawer = root.querySelector<HTMLElement>(
        "[data-platform-nav-drawer]"
    );
    const links = drawer?.querySelectorAll<HTMLAnchorElement>("a");
    const closeButtons = root.querySelectorAll<HTMLElement>(
        "[data-platform-nav-close]"
    );
    const toggleIcon = toggle?.querySelector<HTMLElement>(
        "[data-platform-nav-toggle-icon]"
    );

    if (!toggle || !drawer) return;

    const renderToggleIcon = (iconName: "menu" | "x") => {
        if (!toggleIcon) return;
        toggleIcon.innerHTML = PLATFORM_TOGGLE_ICONS[iconName];
    };

    const close = () => {
        root.setAttribute(PLATFORM_NAV_OPEN_ATTR, "false");
        toggle.setAttribute("aria-expanded", "false");
        drawer?.setAttribute("aria-hidden", "true");
        toggle.classList.remove("is-active");
        renderToggleIcon("menu");
    };

    const open = () => {
        root.setAttribute(PLATFORM_NAV_OPEN_ATTR, "true");
        toggle.setAttribute("aria-expanded", "true");
        drawer?.setAttribute("aria-hidden", "false");
        toggle.classList.add("is-active");
        renderToggleIcon("x");
    };

    renderToggleIcon("menu");

    toggle.addEventListener("click", () => {
        const isOpen = root.getAttribute(PLATFORM_NAV_OPEN_ATTR) === "true";
        if (isOpen) {
            close();
        } else {
            open();
        }
    });

    overlay?.addEventListener("click", close);

    links?.forEach((link) => {
        link.addEventListener("click", close);
    });

    closeButtons.forEach((button) => {
        button.addEventListener("click", close);
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            close();
        }
    });

    document.addEventListener("click", (event) => {
        if (root.getAttribute(PLATFORM_NAV_OPEN_ATTR) !== "true") return;
        const target = event.target as Node;
        if (drawer.contains(target) || toggle.contains(target)) return;
        close();
    });

    window.addEventListener("resize", () => {
        if (!window.matchMedia("(max-width: 960px)").matches) {
            close();
        }
    });

    if (typeof window !== "undefined") {
        window.lucide?.createIcons?.();
    }
};

const initAuthPortal = () => {
    const authModern = document.querySelector<HTMLElement>(".auth-modern");
    if (!authModern) return;

    const loginRadio =
        document.querySelector<HTMLInputElement>("#auth-toggle-login");
    const registerRadio = document.querySelector<HTMLInputElement>(
        "#auth-toggle-register"
    );
    const forms =
        authModern.querySelectorAll<HTMLElement>(".auth-modern__form");
    const panels = authModern.querySelectorAll<HTMLElement>(
        ".auth-modern__panel"
    );
    const loginLabels = document.querySelectorAll<HTMLLabelElement>(
        'label[for="auth-toggle-login"]'
    );
    const registerLabels = document.querySelectorAll<HTMLLabelElement>(
        'label[for="auth-toggle-register"]'
    );

    const updateState = (mode: "login" | "register") => {
        if (mode === "register") {
            if (registerRadio) {
                registerRadio.checked = true;
                registerRadio.setAttribute("checked", "checked");
            }
            if (loginRadio) {
                loginRadio.checked = false;
                loginRadio.removeAttribute("checked");
            }
        } else {
            if (loginRadio) {
                loginRadio.checked = true;
                loginRadio.setAttribute("checked", "checked");
            }
            if (registerRadio) {
                registerRadio.checked = false;
                registerRadio.removeAttribute("checked");
            }
        }

        authModern.classList.toggle("is-register", mode === "register");
        document.body.classList.toggle(
            "auth-mode-register",
            mode === "register"
        );

        forms.forEach((form) => {
            const isRegisterForm = form.classList.contains(
                "auth-modern__form--register"
            );
            const isActive =
                mode === "register" ? isRegisterForm : !isRegisterForm;
            form.setAttribute("aria-hidden", String(!isActive));
        });

        panels.forEach((panel) => {
            const isRightPanel = panel.classList.contains(
                "auth-modern__panel--right"
            );
            const isActive = mode === "register" ? isRightPanel : !isRightPanel;
            panel.setAttribute("aria-hidden", String(!isActive));
        });
    };

    loginRadio?.addEventListener("change", () => {
        if (!loginRadio.checked) return;
        updateState("login");
    });

    registerRadio?.addEventListener("change", () => {
        if (!registerRadio.checked) return;
        updateState("register");
    });

    loginLabels.forEach((label) => {
        label.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();
            if (!loginRadio) return;
            loginRadio.checked = true;
            if (registerRadio) registerRadio.checked = false;
            updateState("login");
        });
    });

    registerLabels.forEach((label) => {
        label.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();
            if (!registerRadio) return;
            registerRadio.checked = true;
            if (loginRadio) loginRadio.checked = false;
            updateState("register");
        });
    });

    if (registerRadio?.checked) {
        updateState("register");
    } else {
        updateState("login");
    }
};

const initCatalogTabs = () => {
  const containers = document.querySelectorAll<HTMLElement>("[data-catalog-tabs]");
  if (!containers.length) return;

  containers.forEach((container) => {
    const triggers = Array.from(
      container.querySelectorAll<HTMLButtonElement>("[data-catalog-tab-target]")
    );
    const panels = Array.from(
      container.querySelectorAll<HTMLElement>("[data-catalog-panel]")
    );

    if (!triggers.length || !panels.length) return;

    const activateTab = (targetId: string) => {
      triggers.forEach((trigger) => {
        const isActive = trigger.dataset.catalogTabTarget === targetId;
        trigger.setAttribute("aria-selected", String(isActive));
        trigger.tabIndex = isActive ? 0 : -1;
        trigger.classList.toggle("is-active", isActive);
      });

      panels.forEach((panel) => {
        const isActive = panel.dataset.catalogPanel === targetId;
        if (isActive) {
          panel.removeAttribute("hidden");
        } else {
          panel.setAttribute("hidden", "hidden");
        }
      });
    };

    const focusNextTrigger = (currentIndex: number, direction: 1 | -1) => {
      const nextIndex = (currentIndex + direction + triggers.length) % triggers.length;
      triggers[nextIndex].focus();
      triggers[nextIndex].click();
    };

    triggers.forEach((trigger, index) => {
      trigger.addEventListener("click", () => {
        const targetId = trigger.dataset.catalogTabTarget;
        if (!targetId) return;
        activateTab(targetId);
      });

      trigger.addEventListener("keydown", (event) => {
        if (event.key === "ArrowRight" || event.key === "ArrowDown") {
          event.preventDefault();
          focusNextTrigger(index, 1);
        }

        if (event.key === "ArrowLeft" || event.key === "ArrowUp") {
          event.preventDefault();
          focusNextTrigger(index, -1);
        }
      });

      if (trigger.getAttribute("aria-selected") === "true") {
        const targetId = trigger.dataset.catalogTabTarget;
        if (targetId) activateTab(targetId);
      }
    });
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initSiteNavigation);
  document.addEventListener("DOMContentLoaded", initPlatformNav);
  document.addEventListener("DOMContentLoaded", initAuthPortal);
  document.addEventListener("DOMContentLoaded", initCatalogTabs);
} else {
  initSiteNavigation();
  initPlatformNav();
  initAuthPortal();
  initCatalogTabs();
}

export default initSiteNavigation;
