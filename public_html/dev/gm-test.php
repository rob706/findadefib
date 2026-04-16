<?php

include "../../core/config.php";

?>
<html>
<head>
  <title>Find A Defib - Maps Test</title>
  <link rel="stylesheet" href="./style.css" />
  <script type="module" src="./index.js"></script>
    <!-- prettier-ignore -->
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
    ({key: "<?php echo $GM_MapsAPIKey; ?>", v: "weekly" });</script>
</head>
<body>
<style>

:root {
    --building-color: #ff9800;
    --house-color: #0288d1;
    --shop-color: #7b1fa2;
    --warehouse-color: #558b2f;

    --available-color: #1daa0a;
    --unavailable-color: #ff9900;
    --broken-color: #ff0000;
}

/*
 * Optional: Makes the sample page fill the window.
 */
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
}

/*
 * Always set the map height explicitly to define the size of the div element
 * that contains the map.
 */
#map {
    height: 100%;
    width: 100%;
}

/*
 * Property styles in unhighlighted state.
 */
.property {
    align-items: center;
    background-color: #ffffff;
    border-radius: 50%;
    color: #263238;
    display: flex;
    font-size: 14px;
    gap: 15px;
    height: 30px;
    justify-content: center;
    padding: 4px;
    position: relative;
    position: relative;
    transition: all 0.3s ease-out;
    width: 30px;
    transform: translateY(-9px);
    /*z-index: -2;*/
}

.property::after {
    border-left: 9px solid transparent;
    border-right: 9px solid transparent;
    border-top: 9px solid #ffffff;
    content: '';
    height: 0;
    left: 50%;
    position: absolute;
    top: 95%;
    transform: translate(-50%, 0);
    transition: all 0.3s ease-out;
    width: 0;
    /*z-index: 1;*/
}

.property .icon {
    align-items: center;
    display: flex;
    justify-content: center;
    color: #ffffff;
}

.property .icon svg {
    height: 20px;
    width: auto;
}

.property .details {
    display: none;
    flex-direction: column;
    flex: 1;
}

.property .address {
    color: #9e9e9e;
    font-size: 10px;
    margin-bottom: 10px;
    margin-top: 5px;
}

.property .features {
    align-items: flex-end;
    display: flex;
    flex-direction: row;
    gap: 10px;
}

.property .features > div {
    align-items: center;
    background: #f5f5f5;
    border-radius: 5px;
    border: 1px solid #ccc;
    display: flex;
    font-size: 10px;
    gap: 5px;
    padding: 5px;
}

/*
 * Property styles in highlighted state.
 */
.property.highlight {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.2);
    height: 80px;
    padding: 8px 15px;
    width: auto;
}

.property.highlight::after {
    border-top: 9px solid #ffffff;
}

.property.highlight .details {
    display: flex;
}

.property.highlight .icon svg {
    width: 50px;
    height: 50px;
}

.property .bed {
    color: #ffa000;
}

.property .bath {
    color: #03a9f4;
}

.property .size {
    color: #388e3c;
}


/*
 * Status: Available colors.
 */
.property.highlight:has(.available) .icon {
    color: var(--available-color);
}

.property:not(.highlight):has(.available) {
    background-color: var(--available-color);
}

.property:not(.highlight):has(.available)::after {
    border-top: 9px solid var(--available-color);
}

/*
 * Status: Unavailable colors.
 */
.property.highlight:has(.unavailable) .icon, .property.highlight:has(.pads_unknown) .icon, .property.highlight:has(.some_expired_pads) .icon {
    color: var(--unavailable-color);
}

.property:not(.highlight):has(.unavailable), .property:not(.highlight):has(.pads_unknown), .property:not(.highlight):has(.some_expired_pads) {
    background-color: var(--unavailable-color);
}

.property:not(.highlight):has(.unavailable)::after, .property:not(.highlight):has(.pads_unknown)::after, .property:not(.highlight):has(.some_expired_pads)::after {
    border-top: 9px solid var(--unavailable-color);
}

/*
 * Status: Broken colors.
 */
.property.highlight:has(.broken) .icon, .property.highlight:has(.expired_pads) .icon, .property.highlight:has(.battery_issue) .icon  {
    color: var(--broken-color);
}

.property:not(.highlight):has(.broken), .property:not(.highlight):has(.expired_pads), .property:not(.highlight):has(.battery_issue) {
    background-color: var(--broken-color);
}

.property:not(.highlight):has(.broken)::after, .property:not(.highlight):has(.expired_pads)::after, .property:not(.highlight):has(.battery_issue)::after {
    border-top: 9px solid var(--broken-color);
}

</style>
  <gmp-map
    map-id="Main"
    style="height: 100%"
    center="35.894734,14.445731"
    zoom="12"
  >
  </gmp-map>
  <!--
    The `defer` attribute causes the script to execute after the full HTML
    document has been parsed. -->
  <?php /* <script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo $GM_MapsAPIKey; ?>&libraries=maps"
    defer
  ></script>*/?>

        <script src="https://use.fontawesome.com/releases/v6.2.0/js/all.js"></script>

<script src="./js/defibs.php"></script>
  <script>
    async function initMap() {
        //  Request the needed libraries.
        const [{ Map, InfoWindow }, { AdvancedMarkerElement, PinElement }] = await Promise.all([
            google.maps.importLibrary('maps'),
            google.maps.importLibrary('marker'),
        ]);
        // Set Map Settings
        /*const center = { lat: 35.894734, lng: 14.445731 };
        const map = new Map(document.querySelector('gmp-map'),{
            zoom: 12,
            center,
            mapId: Main,
        });*/
        // Get the gmp-map element.
        const mapElement = document.querySelector('gmp-map');
        // Get the inner map.
        const innerMap = mapElement.innerMap;
        // Load InfoWindow
        const infoWindow = new google.maps.InfoWindow({
            content: "",
            disableAutoPan: true,
        });
        // Set map options.
        innerMap.setOptions({
            mapTypeControl: false,
        });
        /*// Create a pin element.
        const myPin = new PinElement({
            scale: 1,
            background: '#30db19',
            borderColor: '#127734',
            glyphText: '+',
            glyphColor: 'white',
        });

        
        // Add a marker positioned at the map center (Uluru).
        const marker = new AdvancedMarkerElement({
            map: innerMap,
            position: { lat: 35.894734, lng: 14.445731 },
            title: 'Defib Test',
        });

        // Append the pin to the marker.
        marker.append(myPin);
        // Append the marker to the map.
        map.Element.append(marker);*/
    
        for (const defib of defibs) {
            const advancedMarkerElement = new google.maps.marker.AdvancedMarkerElement({
                map: innerMap,
                content: buildContent(defib),
                position: defib.position,
                title: defib.description,
                zIndex: -1,
            });
            advancedMarkerElement.addListener('click', () => {
                toggleHighlight(advancedMarkerElement, defib);
            });
        }
    }
    function toggleHighlight(markerView, defib) {
        if (markerView.content.classList.contains('highlight')) {
            markerView.content.classList.remove('highlight');
            markerView.zIndex = -1;
        }
        else {
            markerView.content.classList.add('highlight');
            markerView.zIndex = 1;
        }
    }
    function buildContent(defib) {
        const content = document.createElement('div');
        content.classList.add('property');
        content.innerHTML = `
        <div class="icon">
            <i aria-hidden="true" class="fa fa-icon fa-${defib.type} ${defib.status}" title="${defib.status}"></i>
            <span class="fa-sr-only">${defib.status}</span>
        </div>
        <div class="details">
            <div class="price">${defib.address}</div>
            <div class="address">${defib.description}</div>
            <div class="features">
            <div>
                <i aria-hidden="true" class="fa fa-kit-medical fa-lg bed" title="Pads Expiry"></i>
                <span class="fa-sr-only">Pads Expiry</span>
                <span>${defib.pads_min}</span>
            </div>
            <div>
                <i aria-hidden="true" class="fa fa-battery-full fa-lg bath" title="Battery Status"></i>
                <span class="fa-sr-only">Battery Status</span>
                <span>${defib.battery_status}</span>
            </div>
            <div>
                <i aria-hidden="true" class="fa fa-toolbox fa-lg size" title="Rescue Ready Kit"></i>
                <span class="fa-sr-only">Rescue Ready Lit</span>
                <span>${defib.rescue_ready_kit}</span>
            </div>
            </div>
        </div>
        `;
        return content;
    }


    initMap();
  </script>
</body>
</html>