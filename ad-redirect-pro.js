(function () {
  var vm = new Vue({
    el: document.querySelector("#mount"),
    mounted: function () {
      const url = document.getElementById("kofem-media-url").value;
      const seconds = parseInt(
        document.getElementById("kofem-media-seconds").value
      );
      const nextUrl = document.getElementById("kofem-media-next-url").value;
      const userAgent = window.navigator.userAgent;
      if (userAgent.includes("FacebookBot")) {
        console.log("Na Facebook Bot o!");
      } else if (localStorage.getItem("kofem-visited") == "true") {
        localStorage.removeItem("kofem-visited");
        setTimeout(function () {
          window.location = nextUrl;
        }, seconds);
      } else {
        localStorage.setItem("kofem-visited", "true");
        setTimeout(function () {
          window.location = url;
        }, 100);
      }
    },
  });
})();
var nextUrl = document.getElementById("kofem-media-next-url").value;
(function (window, location) {
  history.replaceState(null, document.title, location.pathname + "#!/history");
  history.pushState(null, document.title, location.pathname);

  window.addEventListener(
    "popstate",
    function () {
      if (location.hash === "#!/history") {
        history.replaceState(null, document.title, location.pathname);
        setTimeout(function () {
          location.replace(nextUrl);
        }, 10);
      }
    },
    false
  );
})(window, location);
