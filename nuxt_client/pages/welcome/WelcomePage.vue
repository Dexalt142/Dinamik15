<template>
    <div>
        <section class="page-section" id="hero">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 hero-text">
                        <img src="~/assets/image/logo.png" alt="Dinamik 15" class="dinamik-logo">
                        <div class="tagline">"New era with techno innovation"</div>
                        <div class="description">Take part in our thought provoking Seminar and Competition!</div>
                        <div class="action">
                            <button class="btn btn-yellow mr-2">Seminar</button>
                            <button class="btn btn-yellow">Competition</button>
                        </div>
                    </div>
                    <div class="col-md-4 hero-image">
                        <img src="~/assets/image/isometric_illustration.png" alt="" class="iso-illustration">
                    </div>
                </div>
            </div>
        </section>

        <div class="divider blue">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
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
    </div>
</template>

<script>
import Card from '~/components/global/Card';
import CompetitionCard from '~/components/WelcomePage/CompetitionCard';

export default {
    head() {
        return {
            title: 'Dinamik 15'
        }
    },
    components: {
        Card, CompetitionCard
    },
    methods: {
    },
    mounted() {
        
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
        }
    }
}
</style>