<div class="floating-buttons position-fixed d-flex flex-column gap-2 z-3" style="bottom: 20px; right: 20px;">
    <div class="floating-button-container position-relative d-flex align-items-center ">
        <a href="{{ route('visitor.form') }}"
            class="btn btn-dark rounded-circle d-flex fs-4 align-items-center justify-content-center p-3"
            target="_blank">
            <i class="fas fa-plus text-white"></i>
        </a>
        <span
            class="tooltip-text roudnded-2 position-absolute bg-white text-dark fw-bold text-nowrap px-2 py-1 shadow-sm small">
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
