@section('meta_title', 'JASA')
@section('page_title', 'HARGA JASA')

@section('page_title_icon')
<i class="metismenu-icon fa fa-credit-card" aria-hidden="true"></i>
{{-- <i class="metismenu-icon fa fa-money" aria-hidden="true"></i> --}}
    {{-- <i class="metismenu-icon fa fa-prescription-bottle-alt"></i> --}}
@endsection

@section('modal')
    <livewire:jasa.import />
@endsection

<div class="row">
    <div class="col-12">
        <div class="mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        {{-- <button class="btn btn-secondary" wire:click="downloadData"><i class="fa fa-file-import"></i>
                            Export
                            Excel</button> --}}
                            <button class="btn btn-secondary" wire:click="importData">
                                <i class="fa fa-file-import"></i>
                                Tambah Harga Jasa
                            </button>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group">
                            <input type="text" class="form-control form-control" wire:model.lazy="search"
                                placeholder="{{ __('Cari Harga Jasa') }}" value="{{ request('search') }}">
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
                        <table class="mb-0 table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Dokter</th>
                                    <th>Harga Jasa</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($user as $users)
                                <livewire:jasa.single :users="$users" :key="time() . $users->id" />
                                @empty
                                    @include('layouts.empty', ['colspan' => 7])
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="m-auto pt-3 pr-3">
                    {{ $user->appends(request()->query())->links() }}
                </div>
                <div wire:loading wire:target="nextPage,gotoPage,previousPage" class="loader-page"></div>
            </div>
        </div>
    </div>
</div>
