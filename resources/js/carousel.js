import EmblaCarousel from "embla-carousel";
import AutoPlay from "embla-carousel-autoplay";

export default class Carousel {
  init(item) {
    let cells = item.querySelectorAll(".carousel-box > *");
    if (!cells[0]) {
      return;
    }

    let sizelg = window.matchMedia("(min-width: 1024px)");
    let sizemd = window.matchMedia("(min-width: 768px)");
    let sizesm = window.matchMedia("(max-width: 767px)");

    let dataCellsLg = item.dataset.cellslg;
    let dataCellsMd = item.dataset.cellsmd;
    let dataCellsSm = item.dataset.cellssm;

    const checkFlexBasis = () => {
      if (sizelg.matches) {
        setFlexBasis(dataCellsLg);
      } else if (sizemd.matches) {
        setFlexBasis(dataCellsMd);
      } else if (sizesm.matches) {
        setFlexBasis(dataCellsSm);
      }
    };

    console.log(cells);
    const setFlexBasis = (data) => {
      cells.forEach((cell) => {
        cell.style.flexBasis = 100 / data + "%";
      });
    };

    window.addEventListener("resize", () => {
      checkFlexBasis();
    });
    checkFlexBasis();

    let dataDots = item.dataset.dots;
    if (dataDots === "true") {
      let dots = document.createElement("div");
      dots.classList.add("carousel-dots");
      cells.forEach((cell, index) => {
        let dot = document.createElement("button");
        dot.classList.add("dot");
        dots.appendChild(dot);
      });
      item.appendChild(dots);
    }

    const addDots = (embla) => {
      let dots = item.querySelectorAll(".dot");
      dots[0].classList.add("is-active");

      embla.on("select", () => {
        dots.forEach((dot, index) => {
          dot.classList.remove("is-active");
          if (index === embla.selectedScrollSnap()) {
            dot.classList.add("is-active");
          }
        });
      });

      dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
          embla.scrollTo(index);
          dot.classList.add("is-active");
        });
      });
    };

    let dataArrows = item.dataset.arrows;
    if (dataArrows === "true") {
      let prev = document.createElement("button");
      prev.classList.add("carousel-arrow", "carousel-arrow-prev");
      prev.innerHTML = "←";
      let next = document.createElement("button");
      next.classList.add("carousel-arrow", "carousel-arrow-next");
      next.innerHTML = "→";
      item.appendChild(prev);
      item.appendChild(next);
    }

    const addArrows = (embla) => {
      let prev = item.querySelector(".carousel-arrow-prev");
      let next = item.querySelector(".carousel-arrow-next");

      prev.addEventListener("click", () => embla.scrollPrev());
      next.addEventListener("click", () => embla.scrollNext());
    };

    let dataAlign = item.dataset.align;
    let dataLoop = item.dataset.loop;
    let dataAutoplay = item.dataset.autoplay;
    if (dataAutoplay !== "false") {
      let isNumber = !isNaN(dataAutoplay);
      let embla = EmblaCarousel(
        item,
        {
          loop: dataLoop === "true",
          align: dataAlign ? dataAlign : "start",
          containScroll: "trimSnaps",
        },
        [AutoPlay({ delay: isNumber ? parseInt(dataAutoplay) : 3000 })],
      );

      if (dataDots === "true") {
        addDots(embla);
      }

      if (dataArrows === "true") {
        addArrows(embla);
      }
    } else {
      let embla = EmblaCarousel(item, {
        loop: dataLoop === "true",
        align: dataAlign ? dataAlign : "start",
        containScroll: "trimSnaps",
      });

      if (dataDots === "true") {
        addDots(embla);
      }

      if (dataArrows === "true") {
        addArrows(embla);
      }
    }
    item.style.opacity = 1;
  }
}
