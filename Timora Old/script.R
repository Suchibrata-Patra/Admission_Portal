#install.packages("jsonlite")  # Install the package
library(jsonlite)             # Load the package
data = fromJSON("/Users/suchibratapatra/Desktop/timora-2/dhbsspv.json")
library(dplyr)

schedule_data = bind_rows(
  lapply(data$schedule, function(x) as.data.frame(x)),
  .id = "Day"
)

view(names(schedule_data))

rm(list=ls())

#install.packages("jsonlite")  # Install the package
library(jsonlite)             # Load the package
data = fromJSON("/Users/suchibratapatra/Desktop/timora-2/dhbsspv.json")
library(dplyr)

schedule_data = bind_rows(
  lapply(data$schedule, function(x) as.data.frame(x)),
  .id = "Day"
)

view(names(schedule_data))

rm(list=ls())
