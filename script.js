// window.onload = function () {
//     const path = window.location.pathname.split("/");

//     switch (path[1]) {
//         case "home":
//             {
//                 loadPage("home");
//                 break;
//             }
//         case "login":
//             {
//                 loadPage("login");
//                 break;
//             }
//         case "register":
//             {
//                 loadPage("register");
//                 break;
//             }
//         default:
//             {
//                 loadPage("404");
//                 break;
//             }
//     }

//     document.querySelectorAll(".menu__item").forEach((item) => {
//         item.addEventListener("click", function () {
//             const path = item.getAttribute("value");
//             loadPage(path);
//         });
//     });

//     function loadPage($path) {
//         if ($path == "") return;

//         const container = document.getElementById("container");

//         const request = new XMLHttpRequest();
//         request.open("GET", "pages/" + $path + "/index.html");
//         request.onload = function () {
//             if (request.status == 200) {
//                 container.innerHTML = request.responseText;
//                 document.title = $path;
//             }
//         };
//         request.onerror = function(error) {
//             console.log("Errooo " + error);
//         };
//         request.send();
//     }
// }