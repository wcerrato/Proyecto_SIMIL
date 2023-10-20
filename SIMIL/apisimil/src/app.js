import express from "express";
import morgan from "morgan";
import similRoutes from "./routes/simil.routes";

const app = express();

app.set("port", 9000);

app.use(morgan("dev"));
app.use(express.json());

app.use("/api/simil", similRoutes);

export default app;