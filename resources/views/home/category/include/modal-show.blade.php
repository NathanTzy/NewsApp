<div class="modal fade" id="basicModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category name : <strong class="uppercase fw-bold">{{ $row->name }}</strong>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <img src="{{ $row->image }}" alt="" class="img-thumbnail">
            </div>
        </div>
    </div>
</div>
