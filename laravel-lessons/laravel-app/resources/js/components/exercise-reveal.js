export const initExerciseReveal = () => {
  const containers = document.querySelectorAll('[data-exercise-reveal]');

  if (!containers.length) {
    return;
  }

  containers.forEach((container) => {
    const toggles = container.querySelectorAll('[data-exercise-reveal-toggle]');

    toggles.forEach((toggle) => {
      const controls = toggle.getAttribute('aria-controls');
      const content = controls ? container.querySelector(`#${controls}`) : null;

      if (!content) return;

      toggle.addEventListener('click', () => {
        const expanded = toggle.getAttribute('aria-expanded') === 'true';
        const nextExpanded = !expanded;

        toggle.setAttribute('aria-expanded', String(nextExpanded));
        content.classList.toggle('is-open', nextExpanded);
        content.setAttribute('aria-hidden', expanded ? 'true' : 'false');

        const icon = toggle.querySelector('i[data-lucide]');
        if (icon) {
          icon.setAttribute('data-lucide', nextExpanded ? 'chevron-up' : 'chevron-down');
        }

        window.lucide?.createIcons?.();
      });
    });
  });
};
