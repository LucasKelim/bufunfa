import { Expense } from "./Expense";

export interface Salary {
    id: number;
    value: string;
    user_id: number;
    created_at: Date;
    expenses: Expense[];
}
