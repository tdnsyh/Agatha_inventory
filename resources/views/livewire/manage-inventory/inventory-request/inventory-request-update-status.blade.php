<div>
    <div class="page-heading">
        {{-- Page-Title --}}
        <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn icon icon-left btn-lg btn-primary"
                                href="{{ route('inventory.request.index') }}">
                                <i class="bi bi-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Production Request Status</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="updateStatus">
                            <div class="form-group">
                                <label class="form-label">Request Date</label>
                                <input class="form-control" type="text"
                                    value="{{ \Carbon\Carbon::parse($productionRequest->request_date)->format('d-m-Y') }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Product</label>
                                <input class="form-control" type="text"
                                    value="{{ $productionRequest->product->code }} - {{ $productionRequest->product->name }} - {{ $productionRequest->product->variant }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quantity</label>
                                <input class="form-control" type="text"
                                    value="{{ $productionRequest->quantity_request }}" readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Current Status</label>
                                <input class="form-control" type="text"
                                    value="{{ ucfirst(str_replace('_', ' ', $productionRequest->status_request)) }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Note</label>
                                <textarea class="form-control" wire:model="note" placeholder="Your Note">{{ $productionRequest->note ?? '' }}</textarea>
                                @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
