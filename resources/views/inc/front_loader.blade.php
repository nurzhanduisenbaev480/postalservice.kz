<div class="loader-wrap">
    <div class="loader-inner">
        <svg>
            <defs>
                <filter id="goo">
                    <fegaussianblur in="SourceGraphic" stddeviation="2" result="blur"></fegaussianblur>
                    <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 5 -2" result="gooey"></fecolormatrix>
                    <fecomposite in="SourceGraphic" in2="gooey" operator="atop"></fecomposite>
                </filter>
            </defs>
        </svg>
    </div>
</div>
