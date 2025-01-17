let $d;

const addLi = ($nav, text) => {
  const $li = $d.createElement("li");
  $li.textContent = text;
  $nav.insertAdjacentElement("afterbegin", $li);
};

const navController = (statusType, $doc) => {
  $d = $doc;
  const $nav = $doc.querySelector(".header-nav");
  if (statusType === null) {
    addLi($nav, "Iniciar Sesión");
  }

  if (statusType === "vendedor") {
    addLi($nav, "Cerrar Sesión");
    addLi($nav, "Compras");
    addLi($nav, "Agregar Producto");
    addLi($nav, "Home");
  }

  if (statusType === "comprador") {
    addLi($nav, "Cerrar Sesión");
    addLi($nav, "Compras");
    addLi($nav, "Carrito");
    addLi($nav, "Deseos");
    addLi($nav, "Home");
  }
};

export const clickListener = (e, host) => {
  const url = "http://" + host + "/";
  switch (e.target.innerHTML) {
    case "Iniciar Sesión":
      location.href = url + "login.html";
      break;
    case "Cerrar Sesión":
      localStorage.clear();
      location.reload();
      break;
    case "Compras":
      location.href = url + "compras.html";
      break;
    case "Agregar Producto":
      location.href = url + "new-product.html";
      break;
    case "Carrito":
      location.href = url + "carrito.html";
      break;
    case "Deseos":
      location.href = url + "deseos.html";
      break;
    case "Home":
      location.href = url + "index.html";
      break;
  }
};

export default navController;
