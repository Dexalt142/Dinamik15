<template>
    <div>
        <section class="page-section" id="hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 hero-text">
                        <img src="~/assets/image/logo_white.png" alt="Dinamik 15" class="dinamik-logo">
                        <div class="tagline">"New era with techno innovation"</div>
                        <div class="description">Take part in our thought provoking Seminar and Competition!</div>
                        <div class="action">
                            <button class="btn btn-yellow mr-2 mb-2">Seminar</button>
                            <button class="btn btn-yellow mb-2">Competition</button>
                        </div>
                    </div>
                    <div class="col-md-4 hero-image">
                        <img src="~/assets/image/isometric_illustration.png" alt="" class="iso-illustration">
                    </div>
                </div>
            </div>
        </section>

        <div class="divider blue responsive">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
            </svg>
        </div>

        <section class="page-section" id="competition">
            <div class="container">
                <div class="title">Competition</div>
                <div class="competition-card-group">
                    <div class="row">
                        <CompetitionCard name="Animasi" description="Deskripsi animasi">
                            <img src="~/assets/image/animation.png" alt="Animation">
                        </CompetitionCard>

                        <CompetitionCard name="Web" description="Deskripsi web">
                            <img src="~/assets/image/web.png" alt="Web">
                        </CompetitionCard>

                        <CompetitionCard name="Iwc" description="Deskripsi iwc">
                            <img src="~/assets/image/iwc.png" alt="Iwc">
                        </CompetitionCard>

                        <CompetitionCard name="Poster" description="Deskripsi poster">
                            <img src="~/assets/image/poster.png" alt="Poster">
                        </CompetitionCard>
                    </div>
                </div>
            </div>
        </section>

        <section class="page-section" id="seminar">
            <div class="container">
                <div class="title">Seminar Nasional</div>
                <div class="subtitle">Optimalisasi Digital Skill untuk Menunjang Terciptanya Society 5.0</div>
            </div>
        </section>

        <div class="divider white">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
            </svg>
        </div>

        <section class="page-section blue" id="timeline">
            <div class="container">
                <div class="title">Timeline</div>
                <div class="row">
                    <div class="col">
                        <Timeline>
                            <TimelineItem date="1 September 2020" title="Pembukaan Pendaftaran"></TimelineItem>
                            <TimelineItem date="10 September 2020" title="Penutupan Pendaftaran"></TimelineItem>
                            <TimelineItem date="15 September 2020" title="Perlombaan Tahap 1"></TimelineItem>
                            <TimelineItem date="20 September 2020" title="Penutupan Tahap 1"></TimelineItem>
                        </Timeline>
                    </div>
                </div>
            </div>
        </section>

        <section class="footer" id="footer">
            <div class="container">
                <div class="title">
                    <img src="~/assets/image/logo_white.png" alt="Dinamik 15">
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="footer-list">
                            <div class="list-name">Supported by</div>
                            <ul>
                                <li><img src="~/assets/image/csupi.png" alt="CS UPI"></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer-list">
                            <div class="list-name">Contacts</div>
                            <ul>
                                <li><a href="https://instagram.com/dinamik_upi">Instagram</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer-list">
                            <div class="list-name">Sponsors</div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="footer-list">
                            <div class="list-name">Media Partners</div>
                        </div>
                    </div>
                </div>

                <div class="credits">
                    Developed by Dinamik 15 Visual Team
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Card from '~/components/global/Card';
import CompetitionCard from '~/components/WelcomePage/CompetitionCard';
import Timeline from '~/components/global/Timeline/Timeline';
import TimelineItem from '~/components/global/Timeline/TimelineItem';

export default {
    components: {
        Card, CompetitionCard, Timeline, TimelineItem
    },
    data() {
        return {
            
        }
    },
    methods: {
        navbarControl() {
            var navbar = $('.dinamik-navbar');

            if($(window).scrollTop() < 200) {
                navbar.addClass('unscrolled');
            }

            $(window).on('scroll', function() {
                var pathName = $nuxt.$route.name;
                ($(this).scrollTop() < 200 && pathName === 'welcome') ? navbar.addClass('unscrolled') : navbar.removeClass('unscrolled');
            });
        } 
    },
    mounted() {
        this.navbarControl();
    },
    beforeDestroy() {
        var navbar = $('.dinamik-navbar');
        navbar.removeClass('unscrolled');
    }
}
</script>

<style lang="scss" scoped>
#hero {
    background-color: #253C88;
    color: #FFF;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 8rem 0;

    .hero-text {
        .dinamik-logo {
            width: 400px;
        }

        .tagline {
            font-weight: 600;
            font-size: 2.5rem;
            margin: 1rem 0;
        }
        
        .description {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
    
    }

    .hero-image {
        .iso-illustration {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        .hero-text {
            margin-bottom: 4rem;

            .dinamik-logo {
                width: 75%;
            }
        }
    }
}
</style>