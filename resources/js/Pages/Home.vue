<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { HDate, Zmanim, Location, Sedra, HebrewCalendar } from "@hebcal/core";
import DailyZmanim from "../Shared/DailyZmanim.vue";
import { getLeyningOnDate } from "@hebcal/leyning";
import CandleLighting from "../Shared/CandleLighting.vue";

const latitude = 53.52469444;
const longitude = -2.25694444;
const timezone = "Europe/London";
const geoLocation = new Location(
    latitude,
    longitude,
    0,
    timezone,
    "Manchester",
);
const options = {
    hour: "numeric",
    minute: "numeric",
    hour12: true,
    timeZone: timezone,
};

const hebrewDate = Zmanim.makeSunsetAwareHDate(geoLocation, new Date(), false);
const todaysZmanim = new Zmanim(geoLocation, hebrewDate, false);

const weeklySedra = new Sedra(new HDate(hebrewDate).getFullYear(), false).get(
    hebrewDate,
);

const candleLighting = HebrewCalendar.calendar({
    candlelighting: true,
    candleLightingMins: 15,
    havdalahDeg: 8,
    location: geoLocation,
    isHebrewYear: true,
    noHolidays: true,
    start: hebrewDate,
    end: hebrewDate.add(7),
    sedrot: true,
    noMinorFast: true,
    noRoshChodesh: true,
    noModern: true,
});
console.log(candleLighting);

const manchesterTemporalHour = (angle1, angle2) => {
    const alot = todaysZmanim.timeAtAngle(angle1, true);
    const tzeit = todaysZmanim.timeAtAngle(angle2, false);
    const temporalHour = (tzeit.getTime() - alot.getTime()) / 12;
    return [alot, temporalHour];
};

const date = ref(hebrewDate);
const zmanim = ref([
    {
        name: "Dawn",
        time: Zmanim.formatTime(
            todaysZmanim.alotHaShachar(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "later",
        hebrewName: "עלות השחר",
    },

    {
        name: "Earliest Tallis & Tefillin A",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(11, true),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "later",
        hebrewName: "זמן ציצית ותפילין א",
    },
    {
        name: "Earliest Tallis & Tefillin B",
        time: Zmanim.formatTime(
            new Date(
                todaysZmanim.timeAtAngle(12, true).getTime() + 15 * 60 * 1000,
            ),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "later",
        hebrewName: "זמן ציצית ותפילין ב",
    },
    {
        name: "Sunrise",
        time: Zmanim.formatTime(
            todaysZmanim.sunrise(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "later",
        hebrewName: "הנץ החמה",
    },
    {
        name: "Shema MGA",
        time: Zmanim.formatTime(
            new Date(
                todaysZmanim.timeAtAngle(12, true).getTime() +
                    manchesterTemporalHour(12, 7.08)[1] * 3,
            ),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "earlier",
        hebrewName: "סוף זמן קריאת שמע מגן אברהם",
    },
    {
        name: "Shema GRA",
        time: Zmanim.formatTime(
            todaysZmanim.sofZmanShma(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "earlier",
        hebrewName: "סוף זמן קריאת שמע גרא",
    },
    {
        name: "Shacharis MGA",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(12, true).getTime() +
                manchesterTemporalHour(12, 7.08)[1] * 4,
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "earlier",
        hebrewName: " סוף זמן תפילה מגן אברהם ",
    },
    {
        name: "Shacharis GRA",
        time: Zmanim.formatTime(
            todaysZmanim.sofZmanTfilla(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "earlier",
        hebrewName: "סוף זמן תפילה גרא",
    },
    {
        name: "Chatzos",
        time: Zmanim.formatTime(
            todaysZmanim.chatzot(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "later",
        hebrewName: "חצות",
    },
    {
        name: "Earliest Mincha",
        time: Zmanim.formatTime(
            Math.max(
                todaysZmanim.minchaGedola(),
                new Date(todaysZmanim.chatzot().getTime() + 30 * 60 * 1000),
            ),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "later",
        hebrewName: "מנחה גדולה",
    },
    {
        name: "Mincha Ketana",
        time: Zmanim.formatTime(
            todaysZmanim.minchaKetana(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "later",
        hebrewName: "מנחה קטנה",
    },
    {
        name: "Plag GRA",
        time: Zmanim.formatTime(
            todaysZmanim.plagHaMincha(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "earlier",
        hebrewName: "פלג המנחה גרא",
    },
    {
        name: "Plag MGA",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(12, true).getTime() +
                manchesterTemporalHour(12, 7.08)[1] * 10.75,
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "earlier",
        hebrewName: "פלג המנחה מגן אברהם",
    },
    {
        name: "Sunset",
        time: Zmanim.formatTime(
            todaysZmanim.sunset(),
            new Intl.DateTimeFormat("en-US", options),
        ),
        stringency: "earlier",
        hebrewName: "שקיעה",
    },
    {
        name: "Nightfall",
        stringency: "later",
        time: Zmanim.formatTime(
            todaysZmanim.timeAtAngle(7.08, false),
            new Intl.DateTimeFormat("en-US", options),
        ),
        hebrewName: "צאת הכוכבים",
    },
    {
        name: "Nightfall RT",
        stringency: "later",
        time: Zmanim.formatTime(
            todaysZmanim.sunsetOffset(72),
            new Intl.DateTimeFormat("en-US", options),
        ),
        hebrewName: "צאת הכוכבים ר'ת",
    },
]);

function formatTanachBookName(bookName) {
    const tanachBookNames = {
        Genesis: "Sefer Bereishis",
        Exodus: "Sefer Shemos",
        Leviticus: "Sefer Vayikra",
        Numbers: "Sefer Bamidbar",
        Deuteronomy: "Sefer Devarim",
        Joshua: "Sefer Yehoshua",
        Judges: "Sefer Shoftim",
        "I Samuel": "Sefer Shmuel Aleph",
        "II Samuel": "Sefer Shmuel Beis",
        "I Kings": "Sefer Melachim Aleph",
        "II Kings": "Sefer Melachim Beis",
        Isaiah: "Sefer Yeshayahu",
        Jeremiah: "Sefer Yirmiyahu",
        Ezekiel: "Sefer Yechezkel",
        Hosea: "Hoshea",
        Joel: "Yoel",
        Amos: "Amos",
        Obadiah: "Ovadyahu",
        Jonah: "Yonah",
        Micah: "Michah",
        Habakkuk: "Habakkuk",
        Zephaniah: "Tzephaniah",
        Haggai: "Chaggai",
        Zechariah: "Zecharyah",
        Malachi: "Malachi",
        Psalms: "Sefer Tehillim",
        Proverbs: "Sefer Mishlei",
        Job: "Sefer Iyov",
        "Song of Songs": "Shir HaShirim",
        Ruth: "Megillas Rua",
        Lamentations: "Megillas Eichah",
        Ecclesiastes: "Koheles",
        Esther: "Megillas Esther",
        Daniel: "Sefer Daniel",
        Ezra: "Sefer Ezra",
        Nehemiah: "Sefer Nechemiah",
        Chronicles: "Sefer Divrei HaYamim",
    };

    return bookName.replace(
        new RegExp(Object.keys(tanachBookNames).join("|"), "g"),
        (match) => tanachBookNames[match],
    );
}
const leyning = getLeyningOnDate(candleLighting[1].date);
console.log(leyning);

const nextCandleLighting = () => {
    return candleLighting[0]?.linkedEvent
        ? candleLighting[0]?.linkedEvent.render("ashkenazi")
        : candleLighting
              .filter((e) => Object.hasOwn(e, "parsha"))[0]
              .render("ashkenazi");
};
</script>

<template>
    <Head title="Home">
        <meta
            type="description"
            content="Home Information"
            head-key="description" />
    </Head>
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl">Home</h1>
            <div class="text-right text-xl">
                <p>
                    {{
                        new Intl.DateTimeFormat("en-GB", {
                            day: "numeric",
                            month: "long",
                            year: "numeric",
                        }).format(new Date())
                    }}
                </p>
                <p>{{ date }}</p>
            </div>
        </div>
        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
            <DailyZmanim :zmanim class="sm:col-span-2" />
            <CandleLighting
                :weeklySedra="weeklySedra"
                :nextCandleLighting="nextCandleLighting"
                :candleLighting="candleLighting"
                :leyning="leyning"
                :formatTanachBookName="formatTanachBookName"
                class="" />
        </div>
    </div>
</template>
