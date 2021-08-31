const nav = document.querySelector(".mobile-nav");
const burger = document.querySelector(".burger-toggle");
const links = nav.querySelectorAll("a");
const burgerClose = document.getElementById("burger-close");

burger.addEventListener("click", () => {
    nav.classList.toggle("inactive-menu");
    // burger.style.display = "none";
    // burgerClose.style.display = "block";
});

// burgerClose.addEventListener("click", () => {
//     nav.classList.toggle("inactive-menu");
//     burger.style.display = "block";
//     burgerClose.style.display = "none";
// });

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
  materialListFull: [],
  materialList: [],
  categoryListFull: [],
  categoryList: [],
  activeCategories: [],
  activeMaterials: [],
  filterByCategory: function(category) {
    let newList;
    if (category.length) {
      newList = myApp.productList.filter(element => element.product_category.toLowerCase() === category.toLowerCase());
    } else {
      newList = myApp.productListFull.filter(element => element.product_category.toLowerCase() !== category.toLowerCase());
    }
    myApp.productList = newList;
    myApp.printProducts();
  },
  filterByMaterial: function(material) {
      let newList = myApp.productListFull.filter(element => element.product_material.toLowerCase() == material.toLowerCase());
      myApp.productList = newList;
      myApp.printProducts();
  },
  selectCategory: function(category) {
      myApp.activeCategory = category;
      myApp.filterByCategory(category);

      if (myApp.activeMaterial) {
        myApp.filterByMaterial(myApp.activeMaterial);
      }
      
      myApp.printProducts();
  },
  selectMaterial: function(material) {
      myApp.activeMaterial = material;

      myApp.filterByMaterial(material);

      if (myApp.activeCategory) {
        myApp.filterByCategory(myApp.activeCategory);
      }
      myApp.printProducts();
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
      myApp.materialList.forEach(element => {
        let id = element.material_id;  
        let item = `
                <input onclick="myApp.toggleMaterial(${id})" type="checkbox" id="${element.material_name}" name="materials" value="${element.material_name}" rel="${element.material_name}">
                <label for="${element.material_name}" class="material">${element.material_name}</label>
              `;
      res += item;
      });

      document.querySelector("#materials").innerHTML = "";
      document.querySelector("#materials").innerHTML = res;
  },
  printCategories: function() {
      let res = "";
      myApp.categoryList.forEach(element => {
          let item = `
                <input type="checkbox" id="${element.category_name}" name="categories" value="${element.category_name}" rel="${element.category_name}">
                <label for="${element.category_name}" class="category">${element.category_name}</label>
              `;
      res += item;
      });

      document.querySelector("#categories").innerHTML = "";
      document.querySelector("#categories").innerHTML = res;
  },
  toggleMaterial: function(material) {
      const selectedMaterial = myApp.materialListFull.find((element) => {
        return element.material_id == material;
      });
      const existingMaterial = myApp.materialList.find((element) => {
        return element.material_id == material;
      });

      if(existingMaterial) {
        const existingMaterial = myApp.materialList.filter((element) => {
          return element.material_id !== material;
        });
      } 
      else {
        myApp.materialList.push(selectedMaterial);
        myApp.activeMaterials.push(selectedMaterial);
      }

      console.log(selectedMaterial);
      console.log(myApp);
  }
}

var allCheckboxes = document.querySelectorAll('input[type=checkbox]');
var allProjects = Array.from(document.querySelectorAll('.project'));
var checked = {};

getChecked('categories');
getChecked('materials');


// allCheckboxes.forEach((el,idx) => {
//   el.addEventListener('change', toggleCheckbox);
// });

function toggleCheckbox(e) {

  getChecked(e.target.name);
  if (e.target.name == "categories") {
    myApp.filterByCategory(e.target.defaultValue);
    // if (!e.target.checked) {
    //   myApp.productList = myApp.productListFull;
      
    // }

    myApp.printProducts();
  }
  else {
    myApp.filterByMaterial(e.target.defaultValue);
  }

}

function getChecked(name) {
  checked[name] = Array.from(document.querySelectorAll('input[name=' + name + ']:checked')).map(function (el) {
    return el.value;
  });
}