export const getUsers = state => {
    // while there is at least one task processing, return true
    return state.users
}
export const getOkrs = state => {
    // while there is at least one task processing, return true
    return state.okrs
}
export const getOkr = state => {

    return state.okr
}
export const globalValues = state => {
 let configValues = {
     categories: ["#Q2C", "#P&S", "#BO", "#R&D"],
     impact_groups: ["PAR", "CUS","EMP"],
     contributors:[
         "@CTO",
         "@IMT",
         "@BS",
         "@NE/IT",
         "@SW",
         "@QA",
         "@PM/C",
         "@ARCH",
    ],
     benefit:[
         "$REV",
         "$CET",
         "$CEE",
         "$COP",
         "$CAP",

     ],
     status:['Proposed','Hold','Completed']
 }
    return  configValues
}

