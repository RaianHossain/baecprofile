@extends('layouts/frontend')
@section('title', 'Home')
@section('content')
    <style>
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      #search-btn:hover {
        background-color: #004080 !important;
      }

      .research-card {
            border: 1px solid #ddd;
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .research-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            cursor: pointer !important;
        }

        .research-img-wrapper {
            padding: .5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .research-img-wrapper img {
            border-radius: 0.75rem;
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .research-text {
            padding: 0.75rem;
        }

        .research-text h5 {
            font-size: 1.05rem;
            margin-bottom: 0.4rem;
        }

        .research-text .designation,
        .research-text .email,
        .research-text .division {
            font-size: 0.73rem;
            color: #161616;
            margin-bottom: 0.01rem;
            text-align: right;
            width: 100%;
            word-break: break-word;
        }
        .research-text .institute {
            font-size: 0.83rem;
            color: #161616;
            margin-bottom: 0.01rem;
            text-align: right;
            width: 100%;
            word-break: break-word;
        }

        .research-text .email  {
            color: #004080 !important;
        }

        .research-text .interest-label {
            font-weight: bold;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            margin-bottom: 0.2rem;
            color: #000;
        }

        .research-text .interests {
            font-size: 0.82rem;
            color: #666;
        }

        .research-card:hover
        .text-primary {
            color: #0058A9 !important;
            text-decoration: underline !important;  
            font-weight: 500 !important;   
        }
    </style>

    <!-- Search Form -->
    <div class="mt-3 mb-3 px-3 px-md-4">
        <div class="row g-2 g-md-3 align-items-center">  <!-- Reduced gap between fields -->
        <!-- Keyword Search -->
        <div class="col-12 col-sm-6 col-lg">
            <input type="text" class="form-control form-control-lg" name="keyword" placeholder="Search...">
        </div>
        
        <!-- Institute Dropdown -->
        <div class="col-12 col-sm-6 col-lg">
            <select class="form-select form-select-lg" name="institute">
            <option value="">All Institutes</option>
            <option value="1">Institute 1</option>
            <option value="2">Institute 2</option>
            </select>
        </div>
        
        <!-- Designation Dropdown -->
        <div class="col-12 col-sm-6 col-lg">
            <select class="form-select form-select-lg" name="Designation">
            <option value="">All Designations</option>
            <option value="1">Designation 1</option>
            <option value="2">Designation 2</option>
            </select>
        </div>
        
        <!-- Search Button -->
        <div class="col-12 col-sm-6 col-lg-auto">  <!-- Auto width column -->
            <button id="search-btn" class="btn btn-primary w-100 py-2" style="background-color: #0058A9; border: none;">
            <i class="fas fa-search"></i>
            </button>
        </div>
        </div>
    </div>

    <!-- researchers -->
    <div class="album py-2">
        <!-- Showing text -->
        {{-- <p class="text-center px-3 py-2 border text-muted" style="width: fit-content; font-size:0.8rem; font-weight: 500;">SHOWING 1 - 10 of 100 RESULTS</p> --}}
        <p class="text-center px-3 py-2 border text-muted" style="width: fit-content; font-size:0.8rem; font-weight: 500;">
          SHOWING {{ $researchers->firstItem() }} - {{ $researchers->lastItem() }} of {{ $researchers->total() }} RESULTS
        </p>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
          <!-- Researcher Card -->
          {{-- <a href="{{ route('frontend.show', ['slug' => 'mahbub_alam']) }}" class="col" style="text-decoration: none">
            <div class="card research-card h-100 overflow-hidden">
              <div class="row g-0">
                <!-- Image: 30% -->
                <div class="col-4 research-img-wrapper">                  
                  <img src="{{ asset('assets/milonvai.png') }}" alt="Dr. Mahbub Alam" class="img-fluid">
                </div>
      
                <!-- Text: 70% -->
                <div class="col-8">
                  <div class="research-text">
                    <h5 class="fw-bold mb-1 text-primary">Dr. Mahbub Alam</h5>
                    <p class="designation">Principal Scientific Officer</p>
                    <p class="institute">Bangladesh Atomic Energy Commission</p>
                    <div class="interest-label">Research Interest</div>
                    <p class="interests mb-0">Nuclear Safety, Radiation Protection, Environmental Monitoring</p>
                  </div>
                </div>
              </div>
            </div>
          </a> --}}
      
          <!-- Repeat cards as needed -->
          {{-- <div class="col">
            <div class="card research-card h-100 overflow-hidden">
              <div class="row g-0">
                <div class="col-4 research-img-wrapper">
                  <img src="{{ asset('assets/image_placeholder.png') }}" alt="Dr. Jane Doe" class="img-fluid">
                </div>
                <div class="col-8">
                  <div class="research-text">
                    <h5 class="fw-bold text-primary mb-1">Dr. Jane Doe</h5>
                    <p class="designation">Principal Research Scientist</p>
                    <p class="institute">International Atomic Research Institute</p>
                    <p class="email">
                      <i class="fas fa-envelope"></i> 
                      <span>email@example.com</span>
                    </p>
                    <p class="phone">
                      <i class="fas fa-phone-alt"></i>
                      <span>+8801XXXXXXXXX</span>
                    </p>
                    <div class="interest-label">Research Interest</div>
                    <p class="interests mb-0">Isotope Applications, Radioactive Waste Management</p>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

          @foreach ($researchers as $researcher) 
            @if($researcher['InstShort'] == 'Release' || $researcher['InstShort'] == 'Missing')        
              @continue
            @else 
              {{-- <div class="col"> --}}
                <a href="{{ route('frontend.show', ['slug' => $researcher['EmpID']]) }}" class="col" style="text-decoration: none;">
                  <div class="card research-card h-100 overflow-hidden" style="border: 1px solid black;">
                    <div class="row g-0">
                      <div class="col-4 research-img-wrapper">
                        @if($researcher['EmpID'] == '02227')
                          <img src="{{ asset('assets/milonvai.png') }}" alt="Dr. Mahbub Alam" class="img-fluid">
                        @else
                          <img src="{{ asset('assets/image_placeholder.png') }}" alt="{{ $researcher['EmpFname'] }}" class="img-fluid">
                        @endif
                      </div>
                      <div class="col-8">
                        <div class="research-text">
                            <div class="d-flex flex-column align-items-end">
                                <h5 class="fw-bold text-primary mb-1" style="font-size: 1.1rem !important; font-weight: 600 !important;">{{ $researcher['EmpTitle']." ".$researcher['EmpFname']." ".$researcher['EmpLname'] }}</h5>
                                
                                <!-- Modified these paragraphs to handle wrapping properly -->
                                <p class="designation text-end" style="text-align: right; width: 100%; font-weight: 500;">{{ $researcher->designation->DesigLong }}</p>
                                <p class="institute text-end" style="text-align: right; width: 100%; word-break: break-word;">{{ $researcher->institute->InstLong }}</p>
                                @if($researcher['DivShort'] != '---')
                                <p class="division text-end" style="text-align: right; width: 100%;">{{ $researcher->division->DivLong }}</p>
                                @endif
                                <p class="email text-end" style="text-align: right; width: 100%;">
                                    <i class="fas fa-envelope"></i> 
                                    <span>{{ $researcher['EmpEmail'] }}</span>
                                </p>
                            </div>
                            <div class="interest-label mt-2">Research Interest</div>
                            <p class="interests mb-0">Isotope Applications, Radioactive Waste Management</p>
                            <p class="interests mb-0">Isotope Applications, Radioactive Waste Management</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              {{-- </div> --}}
            @endif
          @endforeach      
          <!-- Add more cards below... -->
        </div>

        {{-- pagination --}}
        {{-- <div class="mt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                  </li>
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
            </nav>
        </div> --}}
        <!-- Pagination -->
        <div class="mt-3">
          <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                  {{-- Previous Page Link --}}
                  @if ($researchers->onFirstPage())
                      <li class="page-item disabled">
                          <span class="page-link">Previous</span>
                      </li>
                  @else
                      <li class="page-item">
                          <a class="page-link" href="{{ $researchers->previousPageUrl() }}" rel="prev">Previous</a>
                      </li>
                  @endif
      
                  {{-- Always show first page --}}
                  <li class="page-item {{ 1 == $researchers->currentPage() ? 'active' : '' }}">
                      <a class="page-link" href="{{ $researchers->url(1) }}">1</a>
                  </li>
      
                  {{-- Show ellipsis if current page is far from start --}}
                  @if ($researchers->currentPage() > 3)
                      <li class="page-item disabled">
                          <span class="page-link">...</span>
                      </li>
                  @endif
      
                  {{-- Show pages around current page --}}
                  @foreach (range(max(2, $researchers->currentPage() - 1), min($researchers->lastPage() - 1, $researchers->currentPage() + 1)) as $page)
                      <li class="page-item {{ $page == $researchers->currentPage() ? 'active' : '' }}">
                          <a class="page-link" href="{{ $researchers->url($page) }}">{{ $page }}</a>
                      </li>
                  @endforeach
      
                  {{-- Show ellipsis if current page is far from end --}}
                  @if ($researchers->currentPage() < $researchers->lastPage() - 2)
                      <li class="page-item disabled">
                          <span class="page-link">...</span>
                      </li>
                  @endif
      
                  {{-- Always show last page if different from first --}}
                  @if ($researchers->lastPage() > 1)
                      <li class="page-item {{ $researchers->lastPage() == $researchers->currentPage() ? 'active' : '' }}">
                          <a class="page-link" href="{{ $researchers->url($researchers->lastPage()) }}">{{ $researchers->lastPage() }}</a>
                      </li>
                  @endif
      
                  {{-- Next Page Link --}}
                  @if ($researchers->hasMorePages())
                      <li class="page-item">
                          <a class="page-link" href="{{ $researchers->nextPageUrl() }}" rel="next">Next</a>
                      </li>
                  @else
                      <li class="page-item disabled">
                          <span class="page-link">Next</span>
                      </li>
                  @endif
              </ul>
          </nav>
        </div>

    </div>
    
@endsection