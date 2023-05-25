import { Entity, PrimaryGeneratedColumn, Column } from "typeorm";

export enum ROLE {
  ADMIN = "admin",
  OWNER = "owner",
  KASIR = "kasir",
}

@Entity()
export class Users {
  @PrimaryGeneratedColumn("uuid")
  id: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  firstName: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  lastName: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  email: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  username: string;

  @Column({
    type: "varchar",
    length: 255,
  })
  password: string;

  @Column({
    type: "enum",
    enum: ROLE,
  })
  role: ROLE;
}