<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Expired Documents</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-6">
                <div class="description-block border-right">
                    <span class="description-text">Will Expired within 2 months</span>
                    <h4 class="description-header">{{ $documents_expired['documents_will_expired'] }} docs</h4>
                </div>
            </div>
            <div class="col-sm-6 col-6">
                <div class="description-block border-right">
                    <span class="description-text">Already Expired</span>
                    <h4 class="description-header">{{ $documents_expired['documents_expired'] }} docs</h4>
                </div>
            </div>
        </div>
    </div>
</div>