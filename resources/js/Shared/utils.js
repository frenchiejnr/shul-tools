import { HDate, HebrewCalendar } from "@hebcal/core";

/**
 * Gets the full Hebrew name of a member, including their own name, parent's name, and status.
 *
 * @param {Object} member - The member object.
 * @param {String} parent - The parent to get the name of, either "father" or "mother".
 * @returns {String} The full Hebrew name of the member.
 */
export const getHebrewName = (member, parent) => {
    const prefix = member.gender === "male" ? "ben" : "bas";

    const status =
        member.paternal_status === "yisrael"
            ? ""
            : `Ha${member.paternal_status}`;

    const parentName = member[`${parent}s_hebrew_name`];

    const fullName =
        parent === "father"
            ? `${member.hebrew_name} ${prefix} ${parentName} ${status}`
            : `${member.hebrew_name} ${prefix} ${parentName}`;

    return fullName;
};

/**
 * Gets the full Hebrew name of a parent, including their own parent's name and status.
 *
 * @param {Object} member - The member object.
 * @param {String} parent - The parent to get the name of, either "father" or "mother".
 * @returns {String} The full Hebrew name of the parent.
 */
export const getParentName = (member, parent) => {
    const parentName = member[`${parent}s_hebrew_name`];
    const prefix = parent === "father" ? "ben" : "bas";
    const grandparentName =
        parent === "father"
            ? member.paternal_grandfather_hebrew_name
            : member.maternal_grandfather_hebrew_name;

    const status =
        parent === "father"
            ? member.paternal_status === "yisrael"
                ? ""
                : ` Ha${member.paternal_status}`
            : member.maternal_status === "yisrael"
              ? ""
              : ` Ha${member.maternal_status}`;

    const fullName = `${parentName} ${prefix} ${grandparentName}${status}`;

    return fullName;
};

export const getNextYahrzeit = (hebrewDate) => {
    let year = 5785;
    let gregDate = HebrewCalendar.getYahrzeit(
        year,
        new HDate(
            hebrewDate.split("-")[0],
            hebrewDate.split("-")[1],
            hebrewDate.split("-")[2],
        ),
    )?.greg();

    const currentDate = new Date();
    if (gregDate && gregDate < currentDate) {
        year += 1;
        gregDate = HebrewCalendar.getYahrzeit(
            year,
            new HDate(
                hebrewDate.split("-")[0],
                hebrewDate.split("-")[1],
                hebrewDate.split("-")[2],
            ),
        )?.greg();
    }

    if (!gregDate) {
        return {
            date: null,
            readableDate: null,
        };
    }

    const previousEvening = new Date(gregDate?.getTime() - 1000 * 60 * 60 * 24)
        .toLocaleDateString("en-GB", {
            weekday: "short",
            day: "numeric",
        })
        .replace(/(\w{3})/, "$1 Night,");

    return {
        date: gregDate,
        readableDate:
            `${previousEvening} - ${gregDate?.toLocaleDateString("en-GB", {
                weekday: "short",
                day: "numeric",
                year: "numeric",
                month: "short",
            })}` || null,
    };
};

export const sortByNextYahrzeit = (yahrzeit1, yahrzeit2) => {
    const date1 = new Date(
        yahrzeit1.father_next_english_date?.date ??
            yahrzeit1.mother_next_english_date?.date,
    );
    const date2 = new Date(
        yahrzeit2.father_next_english_date?.date ??
            yahrzeit2.mother_next_english_date?.date,
    );
    return date1 - date2;
};
export const isWithinXDays = (next_english_date, days) => {
    const today = new Date();
    const nextWeek = new Date(today.setDate(today.getDate() + days));
    return next_english_date && new Date(next_english_date) < nextWeek;
};
