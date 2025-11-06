const activateTabs = () => {
  const tabContainers = document.querySelectorAll<HTMLElement>('[data-lesson-tabs]');

  tabContainers.forEach((container) => {
    const buttons = Array.from(
      container.querySelectorAll<HTMLButtonElement>('.lesson-tabs__button')
    );
    const contents = Array.from(
      container.querySelectorAll<HTMLElement>('.lesson-tabs__content')
    );

    buttons.forEach((button) => {
      button.addEventListener('click', () => {
        const targetId = button.dataset.target;
        if (!targetId) return;

        buttons.forEach((btn) => btn.classList.remove('lesson-tabs__button--active'));
        contents.forEach((content) => content.classList.remove('lesson-tabs__content--active'));

        button.classList.add('lesson-tabs__button--active');
        const targetContent = contents.find((content) => content.id === targetId);
        if (targetContent) {
          targetContent.classList.add('lesson-tabs__content--active');
        }
      });
    });
  });
};

const initLesson00 = () => {
  activateTabs();
};

export default initLesson00;
