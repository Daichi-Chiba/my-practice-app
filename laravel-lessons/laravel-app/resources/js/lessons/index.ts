import initLesson00 from './lesson00';

declare global {
  interface Window {
    hljs?: {
      highlightAll: () => void;
    };
    lucide?: {
      createIcons: () => void;
    };
  }
}

const setupCommonLibraries = () => {
  if (window.hljs) {
    window.hljs.highlightAll();
  }
  if (window.lucide) {
    window.lucide.createIcons();
  }
};

const lessonInitializers: Record<string, () => void> = {
  'lesson--environment': initLesson00,
};

const initLessonModules = () => {
  setupCommonLibraries();

  const body = document.body;
  Object.entries(lessonInitializers).forEach(([className, initializer]) => {
    if (body.classList.contains(className)) {
      initializer();
    }
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initLessonModules);
} else {
  initLessonModules();
}
