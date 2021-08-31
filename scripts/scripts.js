const nav = document.querySelector(".mobile-nav");
const burger = document.querySelector(".burger-toggle");
const links = nav.querySelectorAll("a");
const burgerClose = document.getElementById("burger-close");

burger.addEventListener("click", () => {
    nav.classList.toggle("inactive-menu");
    // burger.style.display = "none";
    // burgerClose.style.display = "block";
});

links.forEach(link => {
    link.addEventListener('click', () => {
        nav.classList.toggle("inactive-menu");
        // burger.style.display = "block";
        // burgerClose.style.display = "none";
        // burgerImg.src = "./images/icons/burger-menu.svg";
    })
});


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
  init: function(products, categories, materials) {
    myApp.productListFull = products;
    myApp.productList = products;

    myApp.setFilters(products, categories, materials);

    console.log(myApp);

    myApp.printProducts();
    myApp.printMaterials();
    myApp.printCategories();
    myApp.printResultsNr();
  },
  setFilters: function(products, categories, materials) {

    let allCategoriesFromProducts = products.map(product => product.product_category);
    let allMaterialsFromProducts = products.map(product => product.product_material);

    myApp.filters.categories = categories.filter((category) => {
      if (allCategoriesFromProducts.includes(category.category_tag)) {
        return category;
      }
    });
    myApp.filters.materials = materials.filter((material) => {
      if (allMaterialsFromProducts.includes(material.material_tag)) {
        return material;
      }
    });
  },

  filterByMaterial: function() {
    let newProducts = myApp.productList;

    const activeMaterialNames = myApp.filters.materials.filter((mat) => {

      const id = parseInt(mat.material_id);
      if (myApp.activeFilters.materials.includes(id)) {
        return mat;
      }
    }).map(mat => mat.material_tag);

    newProducts = newProducts.filter((prod) => {
      if (activeMaterialNames.includes(prod.product_material)) {
        return prod;
      }

    });

    return newProducts;
  },
  filterByCategory: function() {
    let newProducts = myApp.productList;

    const activeCategoryNames = myApp.filters.categories.filter((cat) => {

      const id = parseInt(cat.category_id);
      if (myApp.activeFilters.categories.includes(id)) {
        return cat;
      }
    }).map(cat => cat.category_tag);

    newProducts = newProducts.filter((prod) => {
      if (activeCategoryNames.includes(prod.product_category)) {
        return prod;
      }
    });

    return newProducts;
  },
  updateProductList: function() {

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
    myApp.printResultsNr();
  },

  printAddedFilters: function() {
    let res = "";

    myApp.filters.materials.forEach(material => {

      if (myApp.activeFilters.materials.includes(parseInt(material.material_id))) {
        let item = `
          <div class="added-filter">
            <img onclick="myApp.toggleMaterial(${parseInt(material.material_id)})" src="../images/icons/close-filter.svg" alt="">
            <p>${material.material_name}</p>
          </div>
        `;
        res += item;
      }
    });

    myApp.filters.categories.forEach(category => {

      if (myApp.activeFilters.categories.includes(parseInt(category.category_id))) {
        let item = `
          <div class="added-filter">
            <img onclick="myApp.toggleCategory(${parseInt(category.category_id)})" src="../images/icons/close-filter.svg" alt="">
            <p>${category.category_name}</p>
          </div>
        `;
        res += item;
      }
    });

    document.querySelector("#added-filters").innerHTML = "";
    document.querySelector("#added-filters").innerHTML = res;


  },
  printResultsNr: function() {

    let res = `${myApp.productList.length} Results`;
    if (myApp.productList.length === 1) {
      res = '1 Result';
    }
    document.querySelector("#results").innerHTML = res;
  },
  printProducts: function() {
      let res = "";
      myApp.productList.forEach(element => {
          let item = `
              <a href="../project/project.php?product=${element.product_id}" class="all-projects">
              <div class="project">
                  <img src="../images/products/${element.product_id}/${element.product_featured_photo}" alt="" class="project-img" />
                  <div class="project-info">
                      <h4>${element.product_name}</h4>
                      <p>${element.product_short_description}</p>
                      <img src="../images/icons/arrow.svg" alt="">
                  </div>
              </div>
              </a>
              `;
      res += item;
      });

      document.querySelector("#project-center-new").innerHTML = "";
      document.querySelector("#project-center-new").innerHTML = res;
  },
  printMaterials: function() {
      let res = "";
      myApp.filters.materials.forEach(element => {
        let id = element.material_id;  
        let item = `
                <input data-material="${id}" type="checkbox" id="material${id}" name="materials${id}" value="${element.material_name}" rel="${element.material_name}">
                <label for="material${id}" onclick="myApp.toggleMaterial(${id})" class="material label ${myApp.activeFilters.materials.includes(parseInt(element.material_id)) ? 'checked' : ''}">${element.material_name}</label>
              `;
      res += item;
      });

      document.querySelector("#materials").innerHTML = "";
      document.querySelector("#materials").innerHTML = res;
  },
  printCategories: function() {
      let res = "";
      myApp.filters.categories.forEach(element => {
          let id = element.category_id;  
          let item = `
                <input data-category="${id}" type="checkbox" id="category${id}" name="categories" value="${element.category_name}" rel="${element.category_name}">
                <label for="category${id}" onclick="myApp.toggleCategory(${id})" class="category label ${myApp.activeFilters.categories.includes(parseInt(element.category_id)) ? 'checked' : ''}">${element.category_name}</label>
              `;
      res += item;
      });

      document.querySelector("#categories").innerHTML = "";
      document.querySelector("#categories").innerHTML = res;
  },
  toggleMaterial: function(materialId) {


    debugger;

    if (myApp.activeFilters.materials.includes(materialId)) {
      myApp.activeFilters.materials = myApp.activeFilters.materials.filter((id) => id !== materialId);
    } else {
      myApp.activeFilters.materials.push(materialId);
    }

    myApp.updateProductList();

  },
  toggleCategory: function(categoryId) {

    if (myApp.activeFilters.categories.includes(categoryId)) {
      myApp.activeFilters.categories = myApp.activeFilters.categories.filter((id) => id !== categoryId);
    } else {
      myApp.activeFilters.categories.push(categoryId);
    }

    myApp.updateProductList();

  },

}


