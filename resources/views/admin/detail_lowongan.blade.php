@extends('layout.template')
@section('content')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-medium">Detail Lowongan</h2>
        </div>
        <div>
            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-primary-500 text-primary-500 hover:border-primary-700 hover:text-primary-700 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none">
                <i class="ph ph-note-pencil"></i>
                Edit Lowongan
            </button>
        </div>
    </div>
    <div class="flex justify-start items-center mt-5 w-full bg-white p-4 rounded-md">
        <div class="flex ">
            <img src="{{asset('Images/LOGOPT.png') }}">
            <div class="flex flex-col pl-6 gap-y-2.5">
                <div class="flex gap-4 items-center">
                    <h4 class="font-semibold">UI UX DESIGNER</h4>
                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-md text-xs font-medium border border-teal-500 bg-white text-teal-500">Aktif Merekrut</span>
                </div>
                <p class="text-primary-500 text-sm">
                    PT. Quantum Technology Nusantara
                </p>
                <div class="flex flex-col gap-1">
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-map-pin text-neutral-500 text-xl"></i>
                        <p>Jakarta Selatan, DKI Jakarta, Indonesia</p>
                    </span>
                    <span class="flex items-center gap-2 text-sm text-neutral-700">
                        <i class="ph ph-calendar text-neutral-500 text-xl"></i>
                        <p>Ganjil 2026</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full bg-white p-4 rounded-md mt-5">
        <h4 class="font-semibold">Deskripsi</h4>
        <div class="mt-2">
            <div id="short-description" class="text-neutral-400 text-sm line-clamp-3 whitespace-pre-line">
                {{ $lowongan->deskripsi ?? 'We are seeking a skilled and detail-focused UI/UX Designer to develop engaging, user-friendly interfaces and intuitive digital experiences. You will collaborate closely with product managers, developers, and stakeholders to transform requirements into wireframes.' }}
            </div>
            <div id="full-description" class="text-neutral-400 text-sm hidden whitespace-pre-line">
                {!! nl2br(e($lowongan->deskripsi ?? 'We are seeking a skilled and detail-focused UI/UX Designer to develop engaging, user-friendly interfaces and intuitive digital experiences. You will collaborate closely with product managers, developers, and stakeholders to transform requirements into wireframes, prototypes, and polished designs that meet both user needs and business objectives.

As our UI/UX Designer, you will be responsible for the entire design process, from conducting user research and creating user personas to designing wireframes, interactive prototypes, and final UI components. You should have a strong portfolio demonstrating your design thinking, problem-solving abilities, and attention to detail.

Key Responsibilities:
• Conduct user research and analysis to understand user behaviors, needs, and motivations
• Create user personas, user flows, and journey maps to guide design decisions
• Design wireframes, mockups, and interactive prototypes for various digital products
• Develop and maintain design systems, pattern libraries, and style guides
• Collaborate with developers to ensure proper implementation of designs
• Conduct usability testing and gather user feedback to iterate and improve designs
• Stay up-to-date with the latest UI/UX trends, tools, and emerging technologies

Requirements:
• Bachelor\'s degree in Design, Human-Computer Interaction, or a related field (or equivalent experience)
• 3+ years of experience in UI/UX design for digital products
• Proficiency with design and prototyping tools (Figma, Adobe XD, Sketch)
• Strong portfolio demonstrating your design thinking and process
• Experience with user research methodologies and usability testing
• Excellent visual design skills with a keen eye for detail
• Strong communication and presentation skills
• Ability to work collaboratively in a cross-functional team environment')) !!}
            </div>
            <button id="read-more-btn" class="mt-2 text-primary-500 text-sm font-medium hover:text-primary-700 focus:outline-none flex items-center gap-1">
                <span>Lebih banyak</span>
                <i class="ph ph-caret-down"></i>
            </button>
        </div>
    </div>
    <div class="w-full bg-white p-4 rounded-md mt-5">
        <h4 class="font-semibold">Persyaratan</h4>
        <p class="mt-2 text-neutral-400 text-sm">We are seeking a skilled and detail-focused UI/UX Designer to develop engaging,
            user-friendly interfaces and
            intuitive digital experiences. You will collaborate closely with product managers, developers, and stakeholders
            to transform requirements into wireframes, prototypes, and polished designs that meet both user needs and
            business objectives.</p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const readMoreBtn = document.getElementById('read-more-btn');
            const shortDescription = document.getElementById('short-description');
            const fullDescription = document.getElementById('full-description');
            
            readMoreBtn.addEventListener('click', function() {
                if (shortDescription.classList.contains('hidden')) {
                    // Show less
                    shortDescription.classList.remove('hidden');
                    fullDescription.classList.add('hidden');
                    readMoreBtn.innerHTML = '<span>Lebih banyak</span><i class="ph ph-caret-down"></i>';
                } else {
                    // Show more
                    shortDescription.classList.add('hidden');
                    fullDescription.classList.remove('hidden');
                    readMoreBtn.innerHTML = '<span>Lebih sedikit</span><i class="ph ph-caret-up"></i>';
                }
            });
        });
    </script>
@endsection