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
    const gregDate = HebrewCalendar.getYahrzeit(
        5785,
        new HDate(
            hebrewDate.split("-")[0],
            hebrewDate.split("-")[1],
            hebrewDate.split("-")[2],
        ),
    )?.greg();

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
