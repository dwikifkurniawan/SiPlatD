import * as express from "express";
import * as bodyParser from "body-parser";
import { Request, Response } from "express";
import { AppDataSource } from "./data-source";
import { Routes } from "./routes";
import * as dotenv from "dotenv";
dotenv.config();

AppDataSource.initialize()
  .then(async () => {
    // create express app
    const app = express();
    app.use(bodyParser.json());
    Routes.forEach((route) => {
      (app as any)[route.method](
        route.route,
        async (req: Request, res: Response, next: Function) => {
          try {
            const result = await new (route.controller as any)()[route.action](
              req,
              res,
              next
            );
            res.json(result);
          } catch (err) {
            res.status(err.statusCode || 500).json({ msg: err.message });
          }
        }
      );
    });

    app.get("/", (req, res) =>{
      res.send("hello world");
    });
  })
  .catch((error) => console.log(error));
