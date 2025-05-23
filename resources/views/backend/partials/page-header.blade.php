<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - {{ $title ?? 'Check' }}</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('frontend.home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                {{-- <span class="breadcrumb-item active">Dashboard</span> --}}
                @foreach($breadcrumb ?? [] as $item)
                    @if(isset($item['url']))
                        <a href="{{ $item['url'] }}" class="breadcrumb-item">{{ $item['label'] }}</a>
                    @else
                        <span class="breadcrumb-item active">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>