@extends('Frontend.layout')
@section('title', __('About - The Core Value System'))
@section('body')
<div class="rs-container light rev_slider_wrapper">
    <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options='{"delay": 9000, "gridwidth": 1170, "gridheight": 400}'>
        <ul>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/core-value-en.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/mission-en.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/vission-en.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/philosophyofeducation.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
            <li data-transition="fade" class="typo-dark heavy">
                <img src="{{ env('APP_ASSETS') }}assets/frontend/images/gioithieu/identityoflearners.jpg"
                    alt="{{ __('Trường Đại học An Giang') }}"
                    title="{{ __('Trường Đại học An Giang') }}"
                    data-bgposition="center center"
                    data-bgfit="cover"
                    data-bgrepeat="no-repeat"
                    class="rev-slidebg">
            </li>
        </ul>
    </div>
</div><!-- Home Slider -->
<div class="page-default typo-dark">
    <div class="container">
        <div class="blog-single-details">
            <h4>The Core Value System</h4>
            <p class="text-justify">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/core-values-thumbnail.jpg" alt="Trường Đại học An Giang" style="float:left;width:250px;margin-right:20px;">
                The core value system is the fundamental value system of the organizational culture related to the University's quality which was built up during the process of the University’s existence and development. It is considered as values, beliefs, principles, standards and traditions and is deeply ingrained in all activities of the educational institution. It governs the emotions, thoughts and actions of all members of the University in pursuit of the mission and quality goals. The core value system of the University is identified as Integrity - Dedication - Creativity.</strong>
            </p>
            <p class="text-justify"><strong>Integrity:</strong> Acting according to cultural values, complying with the standards of professional ethics, and respecting cooperation, connection and community service.</p>
            <p class="text-justify"><strong>Dedication:</strong> Acting with all devotion and passion for the job; taking dedication as the foundation for all thoughts and actions.</p>
            <p class="text-justify"><strong>Creativity:</strong> Acting through the incessant innovation and quality improvement to acquire new heights, daring to be different, and demonstrating pioneering aspirations.</p>
            <h4>Educational Philosophy</h4>
            <p class="text-justify">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/education-philosophy-thumbnail.jpg" alt="Trường Đại học An Giang" style="float:left;width:250px;margin-right:20px;">
                Educational philosophy is a set of values practiced by the University and all its lecturers affecting the purpose of the learning process, the role of lecturers, and of content and teaching methods. Based on its mission, vision, core value system and on the identity of the learners, the University’s educational philosophy is considered to be constructive and liberal in order to meet the goals of comprehensive education for learners in terms of quality and competence in the global context. This educational philosophy is the guideline for the educational process which is stated in the educational goals that the University has declared.
            </p>
            <p class="text-justify">
                <strong>Constructivist Education</strong> <br />
                Knowledge is viewed as a product created through experience and interaction with the surrounding environment, the training program is systematically built and developed focusing on output standards. That is to say, subjects providing professional knowledge are integrated and interwoven with other knowledge which helps learners gain meaningful learning experiences with a central role in proactively acquiring knowledge, skills and competencies for professional practice to create new values. At the same time, students are enabled to be active in life, and integrate in a multicultural environment by constantly making efforts with a spirit of willingness to dedicate to fulfill their own aspirations and to serve the society as a whole.
            </p>
            <p class="text-justify">
                <strong>Liberal Education</strong>
                It is assumed that education is the foundation for the comprehensive development of a person, academic freedom and creativity. Our training programis open and flexible, it offers broad overviews but is also in-depth specialisation. It has a balanced structure of both basic and specialized scientific knowledge, it integrates interdisciplinary skills compatible with common level of the region and the world to help learners actively liberate their intelligence in many fields. It makes the most of our students’ creative competence, and fosters their critical thinking for a business career. At the same time, it helps learners gain a good moral foundation, high sense of responsibility, and knowledge how to cultivate and develop universal values: Integrity-Compassion-Excellence in order to adapt flexibly in an ever-changing world.
            </p>
            <h4>Identity of Learners</h4>
            <p class="text-justify">
                <img src="{{ env('APP_URL') }}assets/frontend/images/gioithieu/identity_of_learners.jpg" alt="Trường Đại học An Giang" style="float:left;width:250px;margin-right:20px;">
                The identity of learners is firmly connected with qualities and particular traits for a value- based education. Adaptation Entrepreneurship is considered as the identity of learners at An Giang University.
            </p>
        </div>
    </div>
</div>
@endsection
