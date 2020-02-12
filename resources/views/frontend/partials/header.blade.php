<nav role="navigation black">
    <div class="nav-wrapper container">
        <a id="logo-container" href="/" class="brand-logo">Sunkoshi</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="/rooms">{{__('Room Accomodation')}}</a></li>

            <li>
                <a href="/services">{{__('Services and Facilities')}}</a>
            </li>

            <li>
                <a href="/places">{{__('Nearby Places')}}</a>
            </li>
            <li>
                <img
                    id="imgplus"
                    alt=""
                    src="./assets/icons/uk.png"
                    onmouseover="this.style.cursor='pointer'"
                />
                <span
                    id="flag"
                    onmouseover="this.style.cursor='pointer'"
                    class="black-text"
                >{{__('English')}}</span
                >
            </li>
        </ul>

        <!--Mobile View-->
        <ul id="nav-mobile" class="sidenav">
            <li><a href="/rooms">{{__('Room Accommodation')}}</a></li>

            <li>
                <a href="/services">{{__('Services and Facilities')}}</a>
            </li>

            <li>
                <a href="/places">{{__('Nearby Places')}}</a>
            </li>
            <li>
                <img
                    id="imgplus2"
                    alt="flag"
                    src="./assets/icons/uk.png"
                    onmouseover="this.style.cursor='pointer'"
                />
                <span
                    id="flag2"
                    onmouseover="this.style.cursor='pointer'"
                    class="black-text"
                >{{__('English')}}</span
                >
            </li>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"
        ><i class="material-icons"><img src="{{asset('/storage/'.setting('favicon'))}}"> </i></a
        >
    </div>
</nav>

