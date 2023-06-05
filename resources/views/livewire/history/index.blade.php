@section('meta_title', 'Mediical History')
@section('page_title', 'DATA PEMERIKSAAN ANC')
@section('page_title_icon')
<i class="fa fa-medkit" aria-hidden="true"></i>
    {{-- <i class="metismenu-icon fa fa-notes-medical"></i> --}}
@endsection
<div class="row">
    <div class="col-12">
        <div class="mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control form-control" wire:model.lazy="search"
                                placeholder="{{ __('Cari Medical History') }}" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-default">
                                    <a wire:target="search" wire:loading.remove><i class="fa fa-search"></i></a>
                                    <a wire:loading wire:target="search"><i class="fas fa-spinner fa-spin"></i></a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="mb-0 table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. Hp</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gravida as $index => $record)
                                <livewire:history.single :gravida="$record" :recordIndex="$index + $gravida->firstItem()" :key="$record->id" />
                            @empty
                                @include('layouts.empty', ['colspan' => 7])
                            @endforelse

                                {{-- @forelse($gravida as $gravida)
                                <livewire:history.single :gravida="$gravida" :key="time() . $gravida->id" />
                                @empty
                                    @include('layouts.empty', ['colspan' => 7])
                                @endforelse --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="m-auto pt-3 pr-3">
                    {{-- {{ $gravida->appends(request()->query())->links() }} --}}
                </div>
                <div wire:loading wire:target="nextPage,gotoPage,previousPage" class="loader-page"></div>
            </div>

        </div>
    </div>
</div>
