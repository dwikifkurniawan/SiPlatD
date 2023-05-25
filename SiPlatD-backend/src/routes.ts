import { UsersController } from "./controller/UsersController";
import { MaterialsController } from "./controller/MaterialsController";
import { ProductsController } from "./controller/ProductsController";
import { TransactionsController } from "./controller/TransactionsController";
import { CategoryController } from "./controller/CategoryController";
import { ReportController } from "./controller/ReportController";
import { ManufactureController } from "./controller/ManufactureController";

export const Routes = [
  {
    // Users routes
    method: "get",
    route: "/users",
    controller: UsersController,
    action: "all",
  },
  {
    method: "get",
    route: "/users/:id",
    controller: UsersController,
    action: "one",
  },
  {
    method: "post",
    route: "/users",
    controller: UsersController,
    action: "save",
  },
  {
    method: "delete",
    route: "/users/:id",
    controller: UsersController,
    action: "remove",
  },
  {
    method: "put",
    route: "/users/:id",
    controller: UsersController,
    action: "update",
  },

  // Materials routes
  {
    method: "get",
    route: "/materials",
    controller: MaterialsController,
    action: "all",
  },
  {
    method: "get",
    route: "/materials/:id",
    controller: MaterialsController,
    action: "one",
  },
  {
    method: "post",
    route: "/materials",
    controller: MaterialsController,
    action: "save",
  },
  {
    method: "delete",
    route: "/materials/:id",
    controller: MaterialsController,
    action: "remove",
  },
  {
    method: "put",
    route: "/materials/:id",
    controller: MaterialsController,
    action: "update",
  },

  // Products routes
  {
    method: "get",
    route: "/products",
    controller: ProductsController,
    action: "all",
  },
  {
    method: "get",
    route: "/products/:id",
    controller: ProductsController,
    action: "one",
  },
  {
    method: "post",
    route: "/products",
    controller: ProductsController,
    action: "save",
  },
  {
    method: "delete",
    route: "/products/:id",
    controller: ProductsController,
    action: "remove",
  },
  {
    method: "put",
    route: "/products/:id",
    controller: ProductsController,
    action: "update",
  },

  // Transactions routes
  {
    method: "get",
    route: "/transactions",
    controller: TransactionsController,
    action: "all",
  },
  {
    method: "get",
    route: "/transactions/:id",
    controller: TransactionsController,
    action: "one",
  },
  {
    method: "post",
    route: "/transactions",
    controller: TransactionsController,
    action: "save",
  },
  {
    method: "delete",
    route: "/transactions/:id",
    controller: TransactionsController,
    action: "remove",
  },
  {
    method: "put",
    route: "/transactions/:id",
    controller: TransactionsController,
    action: "update",
  },

  // Category routes
  {
    method: "get",
    route: "/category",
    controller: CategoryController,
    action: "all",
  },
  {
    method: "get",
    route: "/category/:id",
    controller: CategoryController,
    action: "one",
  },
  {
    method: "post",
    route: "/category",
    controller: CategoryController,
    action: "save",
  },
  {
    method: "delete",
    route: "/category/:id",
    controller: CategoryController,
    action: "remove",
  },
  {
    method: "put",
    route: "/category/:id",
    controller: CategoryController,
    action: "update",
  },

  // Report Routes
  {
    method: "get",
    route: "/report",
    controller: ReportController,
    action: "all",
  },
  {
    method: "get",
    route: "/report/:id",
    controller: ReportController,
    action: "one",
  },
  {
    method: "post",
    route: "/report",
    controller: ReportController,
    action: "save",
  },
  {
    method: "delete",
    route: "/report/:id",
    controller: ReportController,
    action: "remove",
  },
  {
    method: "put",
    route: "/report/:id",
    controller: ReportController,
    action: "update",
  },

  // Manufacture routes
  {
    method: "get",
    route: "/manufactures",
    controller: ManufactureController,
    action: "all",
  },
  {
    method: "get",
    route: "/manufactures/:id",
    controller: ManufactureController,
    action: "one",
  },
  {
    method: "post",
    route: "/manufactures",
    controller: ManufactureController,
    action: "save",
  },
  {
    method: "delete",
    route: "/manufactures/:id",
    controller: ManufactureController,
    action: "remove",
  },
  {
    method: "put",
    route: "/manufactures/:id",
    controller: ManufactureController,
    action: "update",
  },
];
export const Routes = [
  {
    // Users routes
    method: "get",
    route: "/users",
    controller: UsersController,
    action: "all",
  },
  {
    method: "get",
    route: "/users/:id",
    controller: UsersController,
    action: "one",
  },
  {
    method: "post",
    route: "/users",
    controller: UsersController,
    action: "save",
  },
  {
    method: "delete",
    route: "/users/:id",
    controller: UsersController,
    action: "remove",
  },
  {
    method: "put",
    route: "/users/:id",
    controller: UsersController,
    action: "update",
  },

  // Materials routes
  {
    method: "get",
    route: "/materials",
    controller: MaterialsController,
    action: "all",
  },
  {
    method: "get",
    route: "/materials/:id",
    controller: MaterialsController,
    action: "one",
  },
  {
    method: "post",
    route: "/materials",
    controller: MaterialsController,
    action: "save",
  },
  {
    method: "delete",
    route: "/materials/:id",
    controller: MaterialsController,
    action: "remove",
  },
  {
    method: "put",
    route: "/materials/:id",
    controller: MaterialsController,
    action: "update",
  },

  // Products routes
  {
    method: "get",
    route: "/products",
    controller: ProductsController,
    action: "all",
  },
  {
    method: "get",
    route: "/products/:id",
    controller: ProductsController,
    action: "one",
  },
  {
    method: "post",
    route: "/products",
    controller: ProductsController,
    action: "save",
  },
  {
    method: "delete",
    route: "/products/:id",
    controller: ProductsController,
    action: "remove",
  },
  {
    method: "put",
    route: "/products/:id",
    controller: ProductsController,
    action: "update",
  },

  // Transactions routes
  {
    method: "get",
    route: "/transactions",
    controller: TransactionsController,
    action: "all",
  },
  {
    method: "get",
    route: "/transactions/:id",
    controller: TransactionsController,
    action: "one",
  },
  {
    method: "post",
    route: "/transactions",
    controller: TransactionsController,
    action: "save",
  },
  {
    method: "delete",
    route: "/transactions/:id",
    controller: TransactionsController,
    action: "remove",
  },
  {
    method: "put",
    route: "/transactions/:id",
    controller: TransactionsController,
    action: "update",
  },

  // Category routes
  {
    method: "get",
    route: "/category",
    controller: CategoryController,
    action: "all",
  },
  {
    method: "get",
    route: "/category/:id",
    controller: CategoryController,
    action: "one",
  },
  {
    method: "post",
    route: "/category",
    controller: CategoryController,
    action: "save",
  },
  {
    method: "delete",
    route: "/category/:id",
    controller: CategoryController,
    action: "remove",
  },
  {
    method: "put",
    route: "/category/:id",
    controller: CategoryController,
    action: "update",
  },

  // Report Routes
  {
    method: "get",
    route: "/report",
    controller: ReportController,
    action: "all",
  },
  {
    method: "get",
    route: "/report/:id",
    controller: ReportController,
    action: "one",
  },
  {
    method: "post",
    route: "/report",
    controller: ReportController,
    action: "save",
  },
  {
    method: "delete",
    route: "/report/:id",
    controller: ReportController,
    action: "remove",
  },
  {
    method: "put",
    route: "/report/:id",
    controller: ReportController,
    action: "update",
  },

  // Manufacture routes
  {
    method: "get",
    route: "/manufactures",
    controller: ManufactureController,
    action: "all",
  },
  {
    method: "get",
    route: "/manufactures/:id",
    controller: ManufactureController,
    action: "one",
  },
  {
    method: "post",
    route: "/manufactures",
    controller: ManufactureController,
    action: "save",
  },
  {
    method: "delete",
    route: "/manufactures/:id",
    controller: ManufactureController,
    action: "remove",
  },
  {
    method: "put",
    route: "/manufactures/:id",
    controller: ManufactureController,
    action: "update",
  },
];
