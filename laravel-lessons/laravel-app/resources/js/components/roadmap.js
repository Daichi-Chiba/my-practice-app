export const initRoadmap = () => {
  const cards = document.querySelectorAll('[data-roadmap-card]');

  const collapseAll = () => {
    cards.forEach((card) => {
      card.classList.remove('is-expanded');
      const details = card.querySelector('[data-roadmap-details]');
      const toggle = card.querySelector('[data-roadmap-toggle]');

      if (details) {
        details.setAttribute('aria-hidden', 'true');
      }

      if (toggle) {
        toggle.setAttribute('aria-expanded', 'false');
        const label = toggle.querySelector('span');
        if (label) label.textContent = '詳しく表示';
        const icon = toggle.querySelector('i[data-lucide]');
        if (icon) icon.setAttribute('data-lucide', 'chevron-down');
      }
    });
  };

  cards.forEach((card) => {
    const toggle = card.querySelector('[data-roadmap-toggle]');
    const details = card.querySelector('[data-roadmap-details]');

    if (!toggle || !details) return;

    toggle.addEventListener('click', () => {
      const expanded = card.classList.toggle('is-expanded');

      if (expanded) {
        collapseAll();
        card.classList.add('is-expanded');
        details.setAttribute('aria-hidden', 'false');
        toggle.setAttribute('aria-expanded', 'true');
        const label = toggle.querySelector('span');
        if (label) label.textContent = '閉じる';
        const icon = toggle.querySelector('i[data-lucide]');
        if (icon) icon.setAttribute('data-lucide', 'chevron-up');
      } else {
        details.setAttribute('aria-hidden', 'true');
        toggle.setAttribute('aria-expanded', 'false');
        const label = toggle.querySelector('span');
        if (label) label.textContent = '詳しく表示';
        const icon = toggle.querySelector('i[data-lucide]');
        if (icon) icon.setAttribute('data-lucide', 'chevron-down');
      }

      window.lucide?.createIcons?.();
    });
  });
};
