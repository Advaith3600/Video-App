<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="content-area">
            <main id="main" class="site-main">
                <div class="success-wrap">
                    <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div>
                    <div class="text-center mb-30">
                        <h2>Something went wrong</h2>
                        <p>Payment could't complete due to some technical error</p>

                        <div class="btn-wrapper">
                            <a href="{{trans_url('checkout')}}" class="btn btn-primary">Try Again</a>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>
<style>
    .swal2-icon.swal2-success {
        border-color: rgb(165, 220, 134);
    }
    [class^="swal2"] {
        -webkit-tap-highlight-color: transparent;
    }
    .swal2-icon {
        position: relative;
        justify-content: center;
        width: 5em;
        height: 5em;
        line-height: 5em;
        cursor: default;
        box-sizing: content-box;
        user-select: none;
        zoom: normal;
        margin: 1.25em auto 1.875em;
        border-width: 0.25em;
        border-style: solid;
        border-image: initial;
        border-radius: 50%;

    }
</style>