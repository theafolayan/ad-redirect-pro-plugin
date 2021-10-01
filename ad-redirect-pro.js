(function () {
  var vm = new Vue({
    el: document.querySelector("#mount"),
    mounted: function () {
      const url = document.getElementById("kofem-media-url").value;
      const seconds = parseInt(
        document.getElementById("kofem-media-seconds").value
      );
      const nextUrl = document
        .getElementById("kofem-media-next-url")
        .value.replace(/\s+/g, "");
      const userAgent = window.navigator.userAgent;
      function random_item(items) {
        return items[Math.floor(Math.random() * items.length)];
      }
      const links = nextUrl.split(",");
      console.log(links);
      if (url.length > 2) {
        if (userAgent.includes("FacebookBot")) {
          console.log("Na Facebook Bot o!");
        } else if (localStorage.getItem("kofem-visited") == "true") {
          localStorage.removeItem("kofem-visited");
          setTimeout(function () {
            window.location = url;
          }, seconds);
        } else {
          localStorage.setItem("kofem-visited", "true");
          setTimeout(function () {
            window.location = random_item(links);
          }, 1000);
        }
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
