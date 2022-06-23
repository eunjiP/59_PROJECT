let totalPrice = 0;
let prices = {};

function makeBasketBox(list) {
  let basketContainer = document.querySelector(".basket-container");

  // console.log(Object.keys(list));
  Object.keys(list).forEach((key) => {
    // console.log(list[key]);
    let menuPhoto = list[key].menu_photo;
    let menuName = list[key].menu_nm;
    let storeName = list[key].store_nm;
    let subedPrice = list[key].subed_price;
    // console.log(subedPrice);
    prices[key] = subedPrice;
    let menuCount = sessionStorage[key];
    let sumPrice = subedPrice * menuCount;
    console.log(sumPrice);

    let basketBox = document.createElement("div");
    basketBox.className += "basket__box";
    basketBox.id = `box${key}`;
    let imgsrc = `img/store/${list[key].store_nm}/Menu_img/${list[key].menu_num}/${list[key].menu_photo}`;
    basketBox.innerHTML = ` 
                <div class="basket__img">
                    <img src="${imgsrc}">
                </div>
                <div class="basket__menu-nm">${menuName}</div>
                <div class="basket__nm-price">
                    <div class="basket__store-nm">${storeName}</div>
                    <div class="basket__price" id="sumPrice${key}">${sumPrice}원</div>
                </div>
                <div class="basket__menu-count">
                  <div class="basket__margin-for-click" id='click${key}'>
                    <div class="basket__change-count basket__minus" id='minus${key}'">-</div>
                            
                    <div class="basket__number" id='count${key}'>${menuCount}</div>
                            
                    <div class="basket__change-count basket__plus" id='plus${key}' ">+</div>
                  </div>
                </div>`;

    basketContainer.append(basketBox);

    totalPrice += sumPrice;
    document.getElementsByClassName("totalPrice")[0].innerText = totalPrice + "원";
    document.getElementsByClassName("totalPrice")[1].innerText = totalPrice + "원";
    sessionStorage["totalPrice"] = totalPrice;
    let countMinus = document.querySelector(`#minus${key}`);
    countMinus.addEventListener("click", function (e) {
      changeCount(key, 0);
      e.stopPropagation();
    });
    let countPlus = document.querySelector(`#plus${key}`);
    countPlus.addEventListener("click", function (e) {
      changeCount(key, 1);
      e.stopPropagation();
    });
    let marginForClick = document.querySelector(`#click${key}`);
    marginForClick.addEventListener("click", (e) => {
      e.stopPropagation();
    });
  });
  return 1;
}

function changeCount(key, pm) {
  console.log(key + ":::" + pm);
  let nowCount = sessionStorage.getItem(key);
  if (pm) {
    sessionStorage.setItem(Number(key), Number(nowCount) + 1);
    console.log("prices:");
    console.log(prices[key]);

    totalPrice = Number(totalPrice) + Number(prices[key]);
  } else {
    sessionStorage.setItem(Number(key), Number(nowCount) - 1);
    totalPrice -= prices[key];
  }
  // console.log(sessionStorage);
  if (sessionStorage.getItem(key) == 0) {
    sessionStorage.removeItem(key);
    document.getElementById(`box${key}`).remove();
  } else {
    document.getElementById(`count${key}`).innerText = sessionStorage.getItem(key);
  }

  let sumPrice = prices[key] * sessionStorage.getItem(key);
  if (sumPrice != 0) {
    document.getElementById(`sumPrice${key}`).innerText = sumPrice;
  }
  document.getElementsByClassName("totalPrice")[0].innerText = totalPrice + "원";
  document.getElementsByClassName("totalPrice")[1].innerText = totalPrice + "원";
  sessionStorage["totalPrice"] = totalPrice;
  checkBoxCount();
}

function goPayment() {
  if (sessionStorage.length == 0) {
    alert("장바구니에 상품이 없습니다");
  } else {
    localStorage.setItem("itemList", JSON.stringify(itemList));
    location.href = "payment.php";
  }
}
function setScroll() {
  let payBoxH = document.querySelector(".basket-payment").clientHeight;
  document.querySelector(".basket-container").style.paddingBottom = payBoxH + 5;
}

function afterBox() {
  checkBoxCount();
  setScroll();
  setBoxLink();
}

function setBoxLink() {
  let itemIds = [];
  Object.keys(itemList).forEach((val) => {
    itemIds.push("box" + val);
  });
  itemIds.forEach((val) => {
    document.querySelector(`#${val}`).addEventListener("click", (e) => {
      window.location = `menu-detail.php?menu_num=${val.substring(3)}`;
      e.stopPropagation();
    });
  });
}

function checkBoxCount() {
  console.log(sessionStorage.length);
  if (sessionStorage.length == 1) {
    let noList = document.createElement("div");
    noList.className += "basket__no-list";
    noList.innerHTML = "<div>🎁선택한 상품이 없습니다</div>";
    console.log(noList);
    document.querySelector(".basket-container").append(noList);
  }
}
