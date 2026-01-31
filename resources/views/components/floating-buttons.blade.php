<div class="position-fixed z-3 d-flex flex-column floating-buttons gap-2" style="bottom: 20px; right: 20px;">
    <div class="position-relative d-flex align-items-center floating-button-container ">
        <a href="{{ route('visitor.form') }}"
            class="d-flex justify-content-center align-items-center p-3 btn btn-dark rounded-circle fs-4"
            target="_blank">
            <i class="text-white fa-plus fas"></i>
        </a>
        <span
            class="position-absolute px-2 py-1 text-dark text-nowrap bg-white shadow-sm fw-bold roudnded-2 small tooltip-text">
            Add Record
        </span>
    </div>
</div>
<style>
    .tooltip-text {
        right: 60px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .floating-button-container:hover .tooltip-text {
        opacity: 1;
        visibility: visible;
    }
</style>
