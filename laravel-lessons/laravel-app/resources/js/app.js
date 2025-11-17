import './bootstrap';
import "../css/lessons/index.css";
import Alpine from "alpinejs";
import { initSiteFeatures } from "./site";
import { initRoadmap } from "./components/roadmap";
import { initExerciseReveal } from "./components/exercise-reveal";

window.Alpine = Alpine;

const initializeFeatures = () => {
  initSiteFeatures();
  initRoadmap();
  initExerciseReveal();
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initializeFeatures);
} else {
  initializeFeatures();
}

Alpine.start();
