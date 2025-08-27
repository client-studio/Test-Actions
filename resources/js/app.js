// Import CSS
import "../css/app.css";
import "../css/editor-style.css";

import Carousel from "./carousel.js";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";

// Configure Alpine
window.Alpine = Alpine;
Alpine.plugin(collapse);

const initAlpineComponents = () => {
  Alpine.data("header", () => ({
    show_infobar: true,
    is_scrolling: false,
    has_scrolled: false,
    scroll_direction: "up",
    show_menu: false,

    init() {
      let lastScrollTop = 0;
      window.addEventListener("scroll", () => {
        let scrollTop = document.documentElement.scrollTop;
        this.scroll_direction = scrollTop > lastScrollTop ? "down" : "up";
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        this.is_scrolling = true;
        this.has_scrolled = scrollTop > 200 ? true : false;
        setTimeout(() => (this.is_scrolling = false), 100);
      });

      window.addEventListener("resize", () => {
        this.show_menu = false;
      });

      let noJS = document.querySelectorAll(".loading");
      if (noJS.length) {
        noJS.forEach((item) => {
          item.classList.remove("loading");
        });
      }

      let lang = document.querySelector("#mobile-menu .lang");
      let enMenu = document.querySelector("#mobile-menu #menu-header-right-1");
      let fiMenu = document.querySelector(
        "#mobile-menu #menu-header-right-fi-1",
      );
      let lastMenu = enMenu ? enMenu : fiMenu;
      lastMenu.appendChild(lang);

      let items = lastMenu.querySelectorAll("li");
      if (items.length) {
        items.forEach((item) => {
          if (item.classList.contains("btn")) {
            lastMenu.appendChild(item);
          }
        });
      }
    },

    effect() {
      if (this.is_scrolling && this.show_menu) {
        this.show_menu = false;
      }
    },
  }));

  Alpine.data("mobileDropdown", () => ({
    openSubmenus: [],
    clickDisabled: [],
    handleClick(event, id) {
      if (document.querySelector(`.menu-item-${id} .sub-menu`)) {
        if (this.openSubmenus.includes(id)) {
          this.openSubmenus = this.openSubmenus.filter((item) => item !== id);
        } else {
          this.openSubmenus.push(id);
          this.clickDisabled.push(id);
        }
        let destination = event.target.href;
        let lastChar = destination.substr(destination.length - 1);
        if (lastChar === "#") {
          event.preventDefault();
        }
      }
    },
  }));

  let moduleFeatures = document.querySelectorAll(
    ".module-feature, .single-taxonomy",
  );
  if (moduleFeatures.length) {
    moduleFeatures.forEach((item) => {
      let text = item.querySelector(".module-feature__text article");
      let headings = text.querySelectorAll("h1, h2, h3");
      if (headings.length) {
        headings.forEach((heading) => {
          heading.classList.add("grower");
        });
      }
    });
  }

  let headerSize = document.querySelector(".header-size");
  if (headerSize) {
    let header = document.querySelector("header");
    headerSize.style.height = header.offsetHeight + "px";
  }

  let modules = document.querySelector(".modules");

  let observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add(
            "opacity-100",
            "translate-y-0",
            "blur-none",
          );
          entry.target.classList.remove(
            "opacity-0",
            "translate-y-10",
            "blur-sm",
          );
        }
      });
    },
    { threshold: 0.2 },
  );

  if (modules) {
    let images = modules.querySelectorAll("img");
    if (images.length > 0) {
      images.forEach((item) => {
        item.classList.add(
          "opacity-0",
          "translate-y-10",
          "transition-all",
          "duration-700",
          "ease-out",
          "blur-sm",
        );
        observer.observe(item);
      });
    }
  }

  let people = document.querySelectorAll(".module-people .person");
  if (people.length) {
    people.forEach((person) => {
      let text = person.querySelector(".small");
      if (!text) {
        return;
      }
      let toggle = person.querySelector(".toggle");
      if (text.offsetHeight > 200) {
        toggle.classList.remove("hidden");
      }
    });
  }
};

// Initialize animations and other DOM-dependent features
const initializeFeatures = () => {
  // Initialize carousels
  const carousels = document.querySelectorAll(".carousel");
  if (carousels.length) {
    const carousel = new Carousel();
    carousels.forEach((item) => carousel.init(item));
  }
};

// Main initialization
document.addEventListener("DOMContentLoaded", () => {
  initAlpineComponents();
  Alpine.start();
  initializeFeatures();
});
