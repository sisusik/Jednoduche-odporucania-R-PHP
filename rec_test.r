set <- read.csv("C:/Users/....csv", header=F)


## vyber prvych dvoch stlpcov (vzorka 100 hodnot - pri tisickach mi mrzol PC)
v1_100<-set[1:100,1]
v2_100<-set[1:100,2]
a_100.data <- data.frame(v1_100,v2_100)
a_100.data



library("recommenderlab")
b <- as(a_100.data, "binaryRatingMatrix")
b

recommenderRegistry$get_entry_names()
recommenderRegistry$get_entry("POPULAR", dataType = "binaryRatingMatrix")

rec <- Recommender(b[1:18], method = "POPULAR")
rec

names(getModel(rec))
getModel(rec)$topN
recom <- predict(rec, b[19:20], n=5)
recom
as(recom, "list")

recom3 <- bestN(recom, n = 3)
recom3
as(recom3, "list")