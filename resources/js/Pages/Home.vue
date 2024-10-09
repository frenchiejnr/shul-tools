<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { GeoLocation, HDate, Zmanim, Location } from "@hebcal/core";

const latitude = 53.52469444;
const longitude = -2.25694444;
const timezone = "Europe/London";
const geoLocation = new Location(
    latitude,
    longitude,
    0,
    timezone,
    "Manchester"
);
const options = {
    hour: "numeric",
    minute: "numeric",
    hour12: true,
    timeZone: timezone,
};

const hebrewDate = Zmanim.makeSunsetAwareHDate(
    geoLocation,
    new Date("01/05/25"),
    false
);
const todaysZmanim = new Zmanim(geoLocation, hebrewDate, false);
console.log(todaysZmanim.getTemporalHourByDeg(12));

const manchesterTemporalHour = (angle1, angle2) => {
    const alot = todaysZmanim.timeAtAngle(angle1, true);
    const tzeit = todaysZmanim.timeAtAngle(angle2, false);
    const temporalHour = (tzeit.getTime() - alot.getTime()) / 12;
    return [alot, temporalHour];
};

const date = ref(hebrewDate);
const zmanim = [
    {
        name: "Dawn",
        time: Zmanim.formatTime(
            todaysZmanim.alotHaShachar(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "later",
        hebrewName: "עלות השחר",
    },

    {
        name: "Earliest Tallis & Tefillin A",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(11, true),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "later",
        hebrewName: "זמן ציצית ותפילין א",
    },
    {
        name: "Earliest Tallis & Tefillin B",
        time: Zmanim.formatTime(
            new Date(
                todaysZmanim.timeAtAngle(12, true).getTime() + 15 * 60 * 1000
            ),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "later",
        hebrewName: "זמן ציצית ותפילין ב",
    },
    {
        name: "Sunrise",
        time: Zmanim.formatTime(
            todaysZmanim.sunrise(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "later",
        hebrewName: "הנץ החמה",
    },
    {
        name: "Shema MGA",
        time: Zmanim.formatTime(
            new Date(
                todaysZmanim.timeAtAngle(12, true).getTime() +
                    manchesterTemporalHour(12, 7.08)[1] * 3
            ),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "earlier",
        hebrewName: "סוף זמן קריאת שמע מגן אברהם",
    },
    {
        name: "Shema GRA",
        time: Zmanim.formatTime(
            todaysZmanim.sofZmanShma(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "earlier",
        hebrewName: "סוף זמן קריאת שמע גרא",
    },
    {
        name: "Shacharis MGA",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(12, true).getTime() +
                manchesterTemporalHour(12, 7.08)[1] * 4,
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "earlier",
        hebrewName: " סוף זמן תפילה מגן אברהם ",
    },
    {
        name: "Shacharis GRA",
        time: Zmanim.formatTime(
            todaysZmanim.sofZmanTfilla(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "earlier",
        hebrewName: "סוף זמן תפילה גרא",
    },
    {
        name: "Chatzos",
        time: Zmanim.formatTime(
            todaysZmanim.chatzot(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "later",
        hebrewName: "חצות",
    },
    {
        name: "Earliest Mincha",
        time: Zmanim.formatTime(
            Math.max(
                todaysZmanim.minchaGedola(),
                new Date(todaysZmanim.chatzot().getTime() + 30 * 60 * 1000)
            ),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "later",
        hebrewName: "מנחה גדולה",
    },
    {
        name: "Mincha Ketana",
        time: Zmanim.formatTime(
            todaysZmanim.minchaKetana(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "later",
        hebrewName: "מנחה קטנה",
    },
    {
        name: "Plag GRA",
        time: Zmanim.formatTime(
            todaysZmanim.plagHaMincha(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "earlier",
        hebrewName: "פלג המנחה גרא",
    },
    {
        name: "Plag MGA",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(12, true).getTime() +
                manchesterTemporalHour(12, 7.08)[1] * 10.75,
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "earlier",
        hebrewName: "פלג המנחה מגן אברהם",
    },
    {
        name: "Sunset",
        time: Zmanim.formatTime(
            todaysZmanim.sunset(),
            new Intl.DateTimeFormat("en-US", options)
        ),
        stringency: "earlier",
        hebrewName: "שקיעה",
    },
    {
        name: "Nightfall",
        stringency: "later",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(7.08, false),
            new Intl.DateTimeFormat("en-US", options)
        ),
        hebrewName: "צאת הכוכבים",
    },
    {
        name: "Nightfall RT",
        stringency: "later",
        time: Zmanim.formatTime(
            todaysZmanim.sunsetOffset(72),
            new Intl.DateTimeFormat("en-US", options)
        ),
        hebrewName: "צאת הכוכבים ר'ת",
    },
];
</script>

<template>
    <Head title="Home">
        <meta
            type="description"
            content="Home Information"
            head-key="description" />
    </Head>
    <h1 class="text-3xl">Home</h1>
    <div>
        <h2>{{ date }}</h2>
        <ul>
            <li v-for="zman in zmanim" :key="zman.name">
                {{ zman.name }} : {{ zman.time }} : {{ zman.hebrewName }}
            </li>
        </ul>
    </div>
</template>
