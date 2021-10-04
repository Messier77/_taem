const body = document.querySelector("body");
const nav = document.querySelector(".mobile-nav");
const mainNav = document.querySelector("nav");
const burger = document.querySelector(".burger-image");
const logo = document.querySelector(".logo");
const links = nav.querySelectorAll("a");
const burgerClose = document.getElementById("burger-close");
const textarea = document.querySelector(".textarea");

function auto_grow(element) {
  element.style.height = "5px";
  element.style.height = (element.scrollHeight + 8)+"px";
  textarea.style.height = "5px";
  textarea.style.height = (element.scrollHeight + 2)+"px";
}

function toggleImg() {
  const initialImg = document.querySelector(".burger-image").src;
  const srcTest = initialImg.includes("burger-menu.svg");
  let newImg = {
    'true':'./images/icons/burger-menu-close.svg', 
    'false':'./images/icons/burger-menu.svg'}[srcTest];

  return newImg;
}

burger.addEventListener("click", () => {
  nav.classList.toggle("mobile-nav-active");
  body.classList.toggle("disable-scroll");
  burger.src = toggleImg();
});

links.forEach(link => {
  link.addEventListener('click', () => {
    nav.classList.toggle("mobile-nav-active");
    body.classList.toggle("disable-scroll");
  })
});

window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mainNav.classList.add("scroll-nav");
  } else {
    mainNav.classList.remove("scroll-nav");
  }
}

let myApp = {
  productListFull: [],
  productList: [],
  filters: {
    materials: [],
    categories: []
  },
  activeFilters: {
    materials: [],
    categories: []
  },
  init: function (products, categories, materials) {

    products = products.map(product => {
      product.product_categories = product.product_categories.split(',');
      product.product_materials = product.product_materials.split(',');
      return product;
    });
    myApp.productListFull = products;
    myApp.productList = products;

    myApp.setFilters(products, categories, materials);

    myApp.printProducts();
    myApp.printMaterials();
    myApp.printCategories();
    // myApp.printResultsNr();
  },
  setFilters: function (products, categories, materials) {

    let allCategoriesFromProducts = products.map(product => product.product_categories).join().split(',');
    let allMaterialsFromProducts = products.map(product => product.product_materials).join().split(',');

    myApp.filters.categories = categories.filter((category) => {
      if (allCategoriesFromProducts.includes(category.id)) {
        return category;
      }
    });
    myApp.filters.materials = materials.filter((material) => {
      if (allMaterialsFromProducts.includes(material.id)) {
        return material;
      }
    });
  },

  filterByMaterial: function () {
    let newProducts = myApp.productList;

    const activeMaterialIds = myApp.filters.materials.filter((mat) => {
      const id = parseInt(mat.id);
      if (myApp.activeFilters.materials.includes(id)) {
        return mat;
      }
    }).map(mat => mat.id);

    newProducts = newProducts.filter((prod) => {
      let hasMaterial = false;

      prod.product_materials.forEach((material) => {
        if (activeMaterialIds.includes(material)) {
          hasMaterial = true;
        }
      });
      if (hasMaterial) {
        return prod;
      }

    });

    return newProducts;
  },
  filterByCategory: function () {
    let newProducts = myApp.productList;
    const activeCategoryIds = myApp.filters.categories.filter((cat) => {

      const id = parseInt(cat.id);
      if (myApp.activeFilters.categories.includes(id)) {
        return cat;
      }
    }).map(cat => cat.id);

    newProducts = newProducts.filter((prod) => {

      let hasCategory = false;

      prod.product_categories.forEach((category) => {
        if (activeCategoryIds.includes(category)) {
          hasCategory = true;
        }
      });
      if (hasCategory) {
        return prod;
      }
    });

    return newProducts;
  },
  updateProductList: function () {

    myApp.productList = myApp.productListFull;

    if (myApp.activeFilters.materials.length) {
      myApp.productList = myApp.filterByMaterial();
    }

    if (myApp.activeFilters.categories.length) {
      myApp.productList = myApp.filterByCategory();
    }
    myApp.printProducts();
    myApp.printCategories();
    myApp.printMaterials();

    myApp.printAddedFilters();
    // myApp.printResultsNr();
  },

  printAddedFilters: function () {
    let res = "";

    myApp.filters.categories.forEach(category => {

      if (myApp.activeFilters.categories.includes(parseInt(category.id))) {
        let item = `
          <div class="added-filter">
            <img onclick="myApp.toggleCategory(${parseInt(category.id)})" src="./images/icons/close-filter.svg" alt="">
            <p>${category.name}</p>
          </div>
        `;
        res += item;
      }
    });

    myApp.filters.materials.forEach(material => {

      if (myApp.activeFilters.materials.includes(parseInt(material.id))) {
        let item = `
          <div class="added-filter">
            <img onclick="myApp.toggleMaterial(${parseInt(material.id)})" src="./images/icons/close-filter.svg" alt="">
            <p>${material.name}</p>
          </div>
        `;
        res += item;
      }
    });

    document.querySelector("#added-filters").innerHTML = "";
    document.querySelector("#added-filters").innerHTML = res;
  },
  printResultsNr: function () {

    let res = `${myApp.productList.length} Results`;
    if (myApp.productList.length === 1) {
      res = '1 Result';
    }
    document.querySelector("#results").innerHTML = res;
  },
  printProducts: function () {
    let res = "";
    myApp.productList.forEach(element => {
      let item = `
              <a href="./project.php?product=${element.slug}" class="all-projects">
              <div class="project">
                  <img src="./images/${element.featured_image ? 'products/' + element.featured_image : 'contact/default.jpg'}" alt="" class="project-img" />
                  <div class="project-info">
                      <h4>${element.name}</h4>
                      <p>${element.short_description}</p>
                      <img src="./images/icons/arrow.svg" alt="">
                  </div>
              </div>
              </a>
              `;
      res += item;
    });

    document.querySelector("#project-center-new").innerHTML = "";
    document.querySelector("#project-center-new").innerHTML = res;
  },
  printMaterials: function () {
    let res = "";
    myApp.filters.materials.forEach(element => {
      let id = parseInt(element.id);
      let item = `
                <input data-material="${id}" type="checkbox" id="material${id}" name="materials${id}" value="${element.name}" rel="${element.name}">
                <label for="material${id}" onclick="myApp.toggleMaterial(${id})" class="material label ${myApp.activeFilters.materials.includes(id) ? 'checked' : ''}">${element.name}</label>
              `;
      res += item;
    });

    document.querySelector("#materials").innerHTML = "";
    document.querySelector("#materials").innerHTML = res;
  },
  printCategories: function () {
    let res = "";
    myApp.filters.categories.forEach(element => {

      let id = parseInt(element.id);
      let item = `
                <input data-category="${id}" type="checkbox" id="category${id}" name="categories" value="${element.name}" rel="${element.name}">
                <label for="category${id}" onclick="myApp.toggleCategory(${id})" class="category label ${myApp.activeFilters.categories.includes(id) ? 'checked' : ''}">${element.name}</label>
              `;
      res += item;
    });

    document.querySelector("#categories").innerHTML = "";
    document.querySelector("#categories").innerHTML = res;
  },
  toggleMaterial: function (materialId) {

    if (myApp.activeFilters.materials.includes(materialId)) {
      myApp.activeFilters.materials = myApp.activeFilters.materials.filter((id) => id !== materialId);
    } else {
      myApp.activeFilters.materials.push(materialId);
    }

    myApp.updateProductList();

  },
  toggleCategory: function (categoryId) {

    if (myApp.activeFilters.categories.includes(categoryId)) {
      myApp.activeFilters.categories = myApp.activeFilters.categories.filter((id) => id !== categoryId);
    } else {
      myApp.activeFilters.categories.push(categoryId);
    }

    myApp.updateProductList();

  },

}


