@extends('layouts/frontend')
@section('title', 'Profile')

@section('content')
    <style>
        .designation,
        .institute {
            font-size: 0.90rem;
            color: #161616;
            margin-bottom: 0.25rem;
        }
    </style>
    <div class="container">
        <div class="row mt-4 py-2 border">
            <div class="col-md-4 d-flex justify-content-center align-items-center">                
                @if($researcher['EmpID'] == '02227')
                    <img src="{{ asset('assets/milonvai.png') }}" alt="Dr. Mahbub Alam" class="img-fluid">
                @else
                    <img src="{{ asset('assets/image_placeholder.png') }}" alt="{{ $researcher['EmpFname'] }}" class="img-fluid">
                @endif                    
            </div>
            <div class="col-md-8 d-flex flex-column justify-content-center align-items-center align-items-sm-center align-items-md-start pt-2 pt-sm-2 pt-md-0"> 
                <h1 class="text-primary">{{ $researcher['EmpTitle']." ".$researcher['EmpFname']." ".$researcher['EmpLname'] }}</h1>
                <p class="text-muted designation">{{ $researcher['DesigLong'] }}</p>
                <p class="text-muted institute">{{ $researcher['InstLong'] }}</p>
                <p class="text-muted institute">{{ $researcher['DivLong'] }}</p>
                <p class="text-muted py-0 my-1"><span style="font-weight: 500; text-decoration: underline">Research Interests:</span> Computer Vision, Machine Learning, Artificial Intelligence</p>
                <p class="text-muted"><span  style="font-weight: 500; text-decoration: underline">Short Bio: </span>{{ $researcher['EmpTitle']." ".$researcher['EmpFname']." ".$researcher['EmpLname'] }} is a dedicated researcher with extensive experience in the fields of Computer Vision, Machine Learning, and Artificial Intelligence. As a Senior Scientific Officer at the Bangladesh Atomic Energy Commission, he has contributed significantly to various projects aimed at advancing nuclear safety and environmental monitoring. His work continues to impact both the scientific community and the general public.</p>       

            </div>
        </div>

        <div class="row mt-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Research And Publication</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Academic Info</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
                </li>
              </ul>
              <div class="tab-content border rounded-bottom p-4" id="myTabContent">
                <!-- Research & Publication Tab -->
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    @if(true)
                        <h4 class="fw-semibold text-primary mb-3">Not Yet Updated</h4>
                    @else
                        <h4 class="fw-semibold text-primary mb-3">Publications</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <h6 class="fw-bold mb-1">Real-time Nuclear Leak Detection using Deep Learning Techniques</h6>
                                <p class="text-muted mb-0">Journal of Advanced Energy Research, 2023</p>
                                <p class="text-muted small">This paper presents a hybrid deep learning approach to detect nuclear leak signatures from real-time video feeds in restricted areas.</p>
                            </li>
                            <li class="mb-3">
                                <h6 class="fw-bold mb-1">Automated Radiation Level Classification using CNN</h6>
                                <p class="text-muted mb-0">Proceedings of IEEE Nuclear Tech Symposium, 2022</p>
                                <p class="text-muted small">This research explores convolutional neural networks to classify and predict hazardous radiation zones more accurately.</p>
                            </li>
                        </ul>
                
                        <h4 class="fw-semibold text-primary mt-4 mb-3">Ongoing Research</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <strong>Project:</strong> Smart Environmental Monitoring using IoT & ML<br>
                                <strong>Funding:</strong> BAEC R&D Grant 2024
                            </li>
                            <li class="list-group-item px-0">
                                <strong>Collaborator:</strong> Atomic Research Institute, Japan<br>
                                <strong>Area:</strong> Fusion Reactor Efficiency Optimization
                            </li>
                        </ul>
                    @endif
                </div>
            
                <!-- Academic Info Tab -->
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    @if(true)
                        <h4 class="fw-semibold text-primary mb-3">Not Yet Updated</h4>
                    @else
                    <h4 class="fw-semibold text-primary mb-3">Education</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <strong>Ph.D. in Computer Science</strong><br>
                            University of Tokyo, Japan – 2018<br>
                            <span class="text-muted small">Focus: AI in Nuclear Systems</span>
                        </li>
                        <li class="list-group-item px-0">
                            <strong>M.Sc. in Computer Science & Engineering</strong><br>
                            Rajshahi University, Rajshahi – 2012
                        </li>
                        <li class="list-group-item px-0">
                            <strong>B.Sc. in Computer Science & Engineering</strong><br>
                            Rajshahi University, Rajshahi – 2010
                        </li>
                    </ul>
            
                    <h4 class="fw-semibold text-primary mt-4 mb-3">Certifications</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            Machine Learning Specialization – Stanford University (Coursera)
                        </li>
                        <li class="list-group-item px-0">
                            Nuclear Safety and Security Training – IAEA, Vienna
                        </li>
                    </ul>
                    @endif
                </div>
            
                <!-- Contact Tab -->
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                    @if(true)
                        <h4 class="fw-semibold text-primary mb-3">Not Yet Updated</h4>
                    @else
                    <h4 class="fw-semibold text-primary mb-3">Contact Information</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0">
                            <strong>Email:</strong> mahbub.alam@baec.gov.bd
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Phone:</strong> +8801XXXXXXXXX
                        </li>
                        <li class="list-group-item px-0">
                            <strong>Office:</strong> Bangladesh Atomic Energy Commission, Dhaka
                        </li>
                    </ul>
            
                    <h5 class="mt-4 mb-2">Social Links</h5>
                    <div>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="bi bi-linkedin"></i> LinkedIn</a>
                        <a href="#" class="btn btn-outline-dark btn-sm"><i class="bi bi-researchgate"></i> ResearchGate</a>
                    </div>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
@endsection
