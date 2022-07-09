let map;

function initMap() {
  
  let point = { lat: 5.570425, lng: -75.118183  };

  map = new google.maps.Map(document.getElementById("map"), {
    center: point,
    zoom: 13,
    
  });

  const marker = new google.maps.Marker({ map, position: point });

  marker.addListener("click", () => {
    infowindow.open(map, marker);
  });
}

window.initMap = initMap;
